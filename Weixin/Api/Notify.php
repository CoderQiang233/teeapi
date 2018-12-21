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
        DI() -> logger -> info('进入支付回调: ');

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




    public function updateOrder($out_trade_no){

        try{
            DI() -> logger -> info('进入支付回调: '.$out_trade_no.'$out_trade_no');
           $order=DI()->notorm->order->where('pay_id',$out_trade_no)->fetchOne();
            $member=DI()->notorm->members->where('id',$order['member_id'])->fetchOne();
            DI() -> logger -> info('订单数据: '.json_encode($order));

            if(Common_OrderStatus::ORDER_STATUS_0 == $order['pay']){
                DI() -> logger -> info('开始修改订单状态: ');

                $rel=DI()->notorm->order->where('pay_id',$out_trade_no)->update(array('pay'=>Common_OrderStatus::ORDER_STATUS_1,'updatedAt'=>date('Y-m-d H:i:s'),'update_date'=>time()));
              
//               修改库存
                DI() -> logger -> info('开始修改商品库存: ');

                $products=DI()->notorm->order_product->where('order_id',$order['order_id'])->fetchAll();

                foreach ($products as $item){
                    $product=DI()->notorm->product->where('product_id',$item['product_id'])->fetchOne();
                    $before=$product['num'];
                    $num=$item['quantity'];
                    $now=$before-$num;
                    DI() -> logger -> info($item['product_id'].'修改库存: '.$now);
                    DI()->notorm->product->where('product_id',$item['product_id'])->update(array('num'=>$now));
                    $this->insertTotalInventoryRecord($item,$member,$product);
                    if ($item['promoter']){
                        DI() -> logger -> info('开始推荐商品返利: ');
                        $promoterId=$item['promoter'];
                        $price=$item['total'];
                        DI() -> logger -> info($item['product_id'].'商品总额: '.$price);
//                        返现比例
                        $brokerage=$product['brokerage'];
                        DI() -> logger -> info('返利比例: '.$brokerage);
                        $cashBack=$price*$brokerage/100;
                        DI() -> logger -> info('返利金额: '.$cashBack);
//                        $promoter=DI()->notorm->members->where('id',$promoterId)->fetchOne();
//                        $balanceBefore=$promoter['balance'];
//                        $balanceNow=$balanceBefore+$cashBack;
//                        DI() -> logger -> info('推荐人原余额: '.$balanceBefore);
//                        DI() -> logger -> info('推荐人现余额: '.$balanceNow);
//                        DI()->notorm->members->where('id',$promoterId)->update(array('balance'=>$balanceNow));
                        $this->insertAddCommissionHistory($item,$cashBack,$promoterId);
                    }
                }

                if ($order['balance_pay']!=0){
                    DI() -> logger -> info('开始余额支付扣除余额: ');
                    $balance=$member['balance'];
                    $balanceNow=$balance-$order['balance_pay'];
                    DI()->notorm->members->where('id',$order['member_id'])->update(array('balance'=>$balanceNow));
                    DI() -> logger -> info('余额扣除成功: ');
                    $this->insertBuyCommissionHistory($order);

                }

                if ($rel==1){
                    DI() -> logger -> info('修改订单状态成功: ');

                    return true;
                }else{
                    return false;
                }
            }elseif (Common_OrderStatus::ORDER_STATUS_1 == $order['pay']){
                return true;
            }

        }catch (Exception $e){

            DI() -> logger -> error('微信支付更新: '.$out_trade_no.'失败',$e);

           

            return false;
        }

    }
    /**
     * @param $order
     * @param $member
     * @param $product
     * @return mixed
     * 添加总部出库信息
     */
    public function insertTotalInventoryRecord($order_product,$member,$product){

        $info=array(
            'product_id' => $order_product['product_id'],//商品id
            'member_id' => $member['id'],//会员id
            'name' =>$member['nick_name'],//会员真实姓名
            'state' => '1',//出库，入库(1出库   2入库)
            'date_added' => date("Y-m-d H:i:s"),//创建时间
            'before_inventory' => $product['num'],//出入库前库存
            'change_inventory' => $order_product['quantity'],//改变的库存(出入库数量)
            'now_inventory' => $product['num']-$order_product['quantity'],//现在库存
            'total_state' => '1',//总部, 代理(1总部   2代理)
            'remark' => $member['name'].'购买出库',//备注
        );
        return DI()->notorm->inventory_record->insert($info);
    }
    /**
     * 添加佣金记录表（增加）
     */
    public function insertAddCommissionHistory($order_product,$cash,$memberId){
        $arr=array(
            'order_product_id'=>$order_product['order_product_id'],
            'type'=>0,//推广金类型
            'total'=>$cash,//金额
            'member_id'=>$memberId,
            'order_id'=>$order_product['order_id'],
            'remark'=>'推广商品获得返利',
            'status'=>0//未结算
        );
        return DI()->notorm->commission_history->insert($arr);
    }
    /**
     * 添加佣金记录表（余额消费）
     */
    public function insertBuyCommissionHistory($order){
        $arr=array(
            'type'=>1,//消费类型
            'total'=>$order['balance_pay'],//金额
            'member_id'=>$order['member_id'],
            'order_id'=>$order['order_id'],
            'remark'=>'余额消费',
            'status'=>1//未结算
        );
        return DI()->notorm->commission_history->insert($arr);
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









