<?php
/**
 * 支付异步/同步回调
 */
class Api_Notify extends PhalApi_Api {

    public function getRules() {
        return array(
            'index' => array(
                'type' 	=> array('name' => 'type', 'type' =>'string', 'require' => true, 'desc' => '引擎类型，比如alipay'),
                'method'    => array('name' => 'method', 'type' =>'string', 'desc' => '回调类型，notify异步/return同步'),
            ),
        );
    }

    /**
     * 支付异步/同步回调
     * @return string 无 根据不同的引擎，返回不同的信息，如果错误信息，则存入日志
     */
    public function index() {
      
              //获取接口数据，如果$_REQUEST拿不到数据，则使用file_get_contents函数获取
    $post = $_REQUEST;
        DI()->logger->debug('gg111'.json_encode($post));

        if ($post == null) {
        $post = file_get_contents("php://input");
    }

    if ($post == null) {
        $post = isset($GLOBALS['HTTP_RAW_POST_DATA']) ? $GLOBALS['HTTP_RAW_POST_DATA'] : '';
    }

    if (empty($post) || $post == null || $post == '') {
        //阻止微信接口反复回调接口  文档地址 https://pay.weixin.qq.com/wiki/doc/api/H5.php?chapter=9_7&index=7，下面这句非常重要!!!
        $str='<xml><return_code><![CDATA[SUCCESS]]></return_code><return_msg><![CDATA[OK]]></return_msg></xml>';
        echo $str;
        exit('Notify 非法回调');
    }
      
      
        //获取对应的支付引擎
        DI()->pay->set($this->type);

        //获取回调信息
        $notify = $GLOBALS['PAY_NOTIFY'];

        if(!$notify) {
            DI()->logger->log('payError','Not data commit', array('Type' => $this->type));
            exit; //直接结束程序，不抛出错误
        }

        //验证
        if(DI()->pay->verifyNotify($notify) == true){
            //获取订单信息
            $info = DI()->pay->getInfo();

            DI()->logger->debug('通知返回信息',$info);

            //TODO 更新对应的订单信息,返回布尔类型


                $res = $this->updateOrder($info['out_trade_no']);


            //订单更新成功
            if($res){
                if ($this->method == "return") {
                    //TODO 同步回调需要跳转的页面
                } else {
                    DI()->logger->log('paySuccess', 'Pay Success',array('Type' => $this->type, 'Method' => $this->method, 'Data'=> $info));

                    //移除超全局变量
                    unset($GLOBALS['PAY_NOTIFY']);

                    //支付接口需要返回的信息，通知接口我们已经接收到了支付成功的状态
                    DI()->pay->notifySuccess();
                    exit; //需要结束程序
                }
            }else{
                DI()->pay->notifyError();
                DI()->logger->log('payError','Failed to pay', $info);
                exit;
            }
        }else{
            DI()->pay->notifyError();
            DI()->logger->log('payError','Verify error', array('Type' => $this->type, 'Method'=> $this->method, 'Data' => $notify));
            exit;
        }
    }




    private function updateOrder($out_trade_no){

        try{

            $order = DI()->notorm->members_order;
            $members=DI()->notorm->members;
            $flag = $order->where('order_id',$out_trade_no)->fetchOne();

            $id=$members->where('order_id',$out_trade_no)->fetchOne();

            $shoping=DI()->notorm->commodity;
            $spOrder=DI()->notorm->commodity_order;
            $members_address=DI()->notorm->members_address;
            $spinfo=$shoping->where('id',1)->fetchOne();
            $address=$members_address->where('member_id',$id['id'])->fetchOne();
            $price=DI()->notorm->members_level->where('level',$flag['level'])->fetchOne();
            $spprice=DI()->notorm->commodity->where('id',1)->fetchOne();
            $data=array(
                'commodity_name'=>$spinfo['name'],
                'commodity_price'=>$spprice['agent_price'],
                'commodity_num'=>$price['level_price'] / $spprice['agent_price'],
                'members_id'=>$id['id'],
                'pay'=>1,
                'create_time'=>date('Y-m-d H:i:s'),
                'openid'=>$flag['openid'],
                'order_id'=>$out_trade_no,
                'shipping_address'=>$address['address'],
                'province_code'=>$address['map_code'],
                'province_name'=>$address['province'],
                'ship_status'=>0,
                'updatedAt'=>date('Y-m-d H:i:s'),
                'update_date' => time(),
                'order_type'=>1,
                'product_id'=>1,
            );

            if(Domain_Pay::ORDER_STATUS_0 == $flag['pay']){
               

                $authorization_number=$this->authorization_number();

                $result = $order ->where('order_id',$out_trade_no)
                    ->update(array('pay'=>Domain_Pay::ORDER_STATUS_1,'updatedAt'=>date('Y-m-d H:i:s')));
				DI()->logger->log('調更新22222','时间'.date('Y-m-d H:i:s'),json_encode($result));
                $result2=$members->where('order_id',$out_trade_no)->update(array('flag'=>Domain_Pay::ORDER_STATUS_1,'authorization_number'=>$authorization_number,'updatedAt'=>date('Y-m-d H:i:s')));
				DI()->logger->log('調更新33333','时间'.date('Y-m-d H:i:s'),json_encode($result2));
                if($data['commodity_num'] != 0){
                    $result3=$spOrder->insert($data);
                }
                if($result3){
                    $inventory=new Api_Notify1();
                    //$order为注册时插入订单表的订单整条消息
                    $order=$spOrder->where('order_id',$data['order_id'])->fetchOne();
                    //调用库存方法
                    $inventory->allotInventory($order);
                }
              

                if($result == 1){
                    if($id['referee_phone']){
                        $this->recordCashBack($id['id']);
                    }
                    //发送注册成功短信
                    $sms = DI()->sms;
                    $param = array(
                        'name'=>$flag['name'],

                    );
                    $response = $sms::sendSms($flag['phone'], 'SMS_145598896', $param);

                    if ($response->Code && $response->Code == 'OK') {
                        // 发送成功后执行的操作
                        DI()->logger->debug('短信发送成功','手机号：'.$flag['phone'].',参数：'.$param);
                    }
                    return true;
                }else{
                    return false;
                }
            }elseif (Domain_Pay::ORDER_STATUS_1 == $flag['pay']){
                return true;
            }

        }catch (Exception $e){

            DI() -> logger -> error('微信支付更新: '.$out_trade_no.'失败',$e);

           

            return false;
        }

    }
    /**
     * 新注册用户信息（带推荐人）记录到返现明细表
     */
    public  function  recordCashBack($id){

         try{
             //获取新注册用户用户信息(下级)
             $members=DI()->notorm->members->where(array('id'=>$id,))->fetchOne();

             //获取推荐人相关信息(上级)
             $referee=DI()->notorm->members->where(array('phone'=>$members['referee_phone'],"flag" => Domain_Pay::ORDER_STATUS_1))->fetchOne();

             $arr=array();

             $arr['member_id']=$members['id'];

             $arr['referee_id']=$referee['id'];

             $arr['member_name']=$members['name'];

             $arr['member_level']=$members['level'];

             $arr['member_price']=$members['level_price'];

             $arr['referee_name']=$referee['name'];

             $arr['referee_level']=$referee['level'];
              //获取代理商返现比例
             $cp=DI()->notorm->cashback_percentage->where(array('level'=>$referee['level'],))->fetchOne();
             $cashback_percentage=$cp['cashback_percentage'];


             $arr['cashback_percentage']=$cashback_percentage.'';//返现比例

             $arr['final_cashback_amount']=$members['level_price']*$cashback_percentage.'';

             $arr['same_month']=$members['level_price']*0.7*$cashback_percentage.'';//当月应返现

             $arr['next_month']=$members['level_price']*0.3*$cashback_percentage.'';//下月结余

             $arr['registration_date']=date("Y-m-d H:i:s",time());//下级注册时间或商品订单下单时间

             $arr['record_date']=date("Y-m",time());//记录时间

             $arr['type']='新用户注册';//记录来源类型

             $arr['commodity_name']='新用户注册';

             DI()->notorm->cash_record->insert($arr);

             //统计注册人信息并计算返现金额记录到cash_month_record表中
             $current=date("Y-m",time());//获取当前年月

             $cashmonth=DI()->notorm->cash_month_record->where(array('cash_time'=>$current,'cash_id'=>$referee['id']))->fetchOne();

             if($cashmonth){
                 //已有记录情况下获取到已有返现费用+新注册人注册费用并更新
               $newprice=$cashmonth['cash_price']+$arr['same_month'];

               DI()->notorm->cash_month_record->where('id',$cashmonth['id'])->update(array('cash_price'=>$newprice));

             }else{
               $datas=array();
               //上月
                 $timestamp=strtotime(date("Y-m"));

               $firstmonth=date('Y-m',strtotime(date('Y',$timestamp).'-'.(date('m',$timestamp)-1)));

               $firstcashmonth=DI()->notorm->cash_month_record->where(array('cash_time'=>$firstmonth,'cash_id'=>$referee['id']))->fetchOne();
               //如果上月返现金额存在
               if($firstcashmonth){
                   //明细表中该受益人当月应返现金额
                   $datas['cash_price']=$firstcashmonth['cash_price']/7*3+$arr['same_month'];
               }else{
                   $datas['cash_price']=$arr['same_month'];
               }


               $datas['cash_time']=date("Y-m",time());

               $datas['cash_id']=$referee['id'];
               //1已返现2未返现
               $datas['status']='2';

               DI()->notorm->cash_month_record->insert($datas);

             }
             return true;
         }catch (Exception $e){
             DI() -> logger -> error('返现明细记录id值: '.$id+'插入失败',$e);

             return false;
         }


    }
}









