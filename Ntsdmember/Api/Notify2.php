<?php
/**
 * 支付异步/同步回调会员升级
 */
class Api_Notify2 extends PhalApi_Api {

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

    function getcode($data){
        $length=6-strlen($data);
        $num='';
        for ($i=0;$i<$length;$i++){
            $num=$num.'0';
        }
        return $num;

    }


    private function updateOrder($out_trade_no){

            try{

                $order = DI()->notorm->upgrade_record;
                $member= DI()->notorm->members;
                $flag = $order->where('order_id',$out_trade_no)->fetchOne();



                $shoping=DI()->notorm->commodity;
                $spOrder=DI()->notorm->commodity_order;
                $members_address=DI()->notorm->members_address;
                $spinfo=$shoping->where('id',1)->fetchOne();
                $address=$members_address->where('member_id',$flag['members_id'])->fetchOne();
                $price=DI()->notorm->members_level->where('level',$flag['up_level'])->fetchOne();
              	$userinfo=$member->where('id',$flag['members_id'])->fetchOne();
                $spprice=DI()->notorm->commodity->where('id',1)->fetchOne();
                $data=array(
                    'commodity_name'=>$spinfo['name'],
                    'commodity_price'=>$spprice['agent_price'],
                    'commodity_num'=>$price['level_price'] / $spprice['agent_price'],
                    'members_id'=>$flag['members_id'],
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
                   $result = $order ->where('order_id',$out_trade_no)->update(array('pay'=>Domain_Pay::ORDER_STATUS_1,'updatedAt'=>date('Y-m-d H:i:s')));
                   $result2 = $member ->where('id',$flag['members_id'])->update(array('level'=>$flag['up_level'],'level_info'=>$flag['up_level_info'],'level_price'=>$flag['up_price'],'updatedAt'=>date('Y-m-d H:i:s')));
                   //根据等级修改授权编号
                    $info=DI()->notorm->members->where('flag',1)->order('authorization_number DESC')->fetchOne();
                    if($info['authorization_number']){
                        $authorization_number=$info['authorization_number'] +1;

                    }else{
                        $authorization_number=108;
                    }
                    if($flag['up_level']!=1){
                        $have=$member ->where('id',$flag['members_id'])->fetchOne();
                        if(!$have['authorization_number']){
                            $code=$this->getcode($authorization_number).$authorization_number;
                            $result = $member->where('id',$flag['members_id'])->update(array('authorization_number'=>$code));
                        }

                    }
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

                    if($result2 == 1){
                        //发送注册成功短信
                        $sms = DI()->sms;
                        $param = array(
                            'name'=>$userinfo['name'],
                            
                        );
                        $response = $sms::sendSms($userinfo['phone'], 'SMS_145598896', $param);

                        if ($response->Code && $response->Code == 'OK') {
                            // 发送成功后执行的操作
                            DI()->logger->debug('短信发送成功','手机号：'+$flag['phone']+',参数：'+$param);
                        }
                        return true;
                    }else{
                        return false;
                    }
                }elseif (Domain_Pay::ORDER_STATUS_1 == $flag['pay']){
                    return true;
                }


            }catch (Exception $e){

                DI() -> logger -> error('微信支付更新: '.$out_trade_no+'失败',$e);

                return false;
            }

    }
}









