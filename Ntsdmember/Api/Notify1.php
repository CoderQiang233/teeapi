<?php
/**
 * 支付异步/同步回调支付商品
 */
class Api_Notify1 extends PhalApi_Api {

	public function getRules() {
        return array(
            'index' => array(
                'type' 	=> array('name' => 'type', 'type' =>'string', 'require' => true, 'desc' => '引擎类型，比如alipay'),
                'method'    => array('name' => 'method', 'type' =>'string', 'desc' => '回调类型，notify异步/return同步'),
            ),
//            'updateOrder' => array(
//                'out_trade_no' 	=> array('name' => 'out_trade_no', 'type' =>'string', 'require' => true, 'desc' => '订单号'),
//            ),

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


    public function updateOrder($out_trade_no){

            try{
//                $out_trade_no=$this->out_trade_no;
                //查出商品订单信息
                $flag = DI()->notorm->commodity_order->where('order_id',$out_trade_no)->fetchOne();

                if(Domain_Pay::ORDER_STATUS_0 == $flag['pay']){

                    //Step 1: 开启事务
                    DI()->notorm->beginTransaction('db_daili');

                   $result = DI()->notorm->commodity_order ->where('order_id',$out_trade_no)->update(array('pay'=>Domain_Pay::ORDER_STATUS_1,'updatedAt'=>date('Y-m-d H:i:s')
                   ,'update_date'=>time()));
                    if($result == 1){
                        //插入库存记录
                        DI()->logger->info('进入记录库存的方法');
                        $this->allotInventory($flag);
                        //Step 3: 提交事务
                        DI()->notorm->commit('db_daili');
                        DI()->logger->info('记录库存的方法结束');
                        //调用返现方法
                        $this->recordCashBackOrder($flag['id']);
                        return true;
                    }else{
                        return false;
                    }
                }elseif (Domain_Pay::ORDER_STATUS_1 == $flag['pay']){
                    return true;
                }

            }catch (Exception $e){

                DI() -> logger -> error('微信支付更新: '.$out_trade_no.'失败',$e);

                // 回滚
                DI()->notorm->rollback('db_daili');

                return false;
            }

    }


    /**
     * 分配代理库存，插入库存记录;扣除总部库存，插入库存记录
     * $order  参数为一条订单信息
     */
    public function allotInventory($order){

        try{

            //购买数量
            $num=$order['commodity_num'];

            //商品ID
            $product_id=$order['product_id'];

            $product=DI()->notorm->commodity->where('id',$product_id)->fetchOne();

            //获取原有数量
            $before=$product['num'];
//            //Step 1: 开启事务
//            DI()->notorm->beginTransaction('db_daili');
            //1).减去总库存,即更新commodity表的num字段
            //现在库存数=原有库存数-购买数量
            $now=$before-$num;

            DI()->notorm->commodity->where('id',$product_id)->update(array('num'=>$now));

            $member_id=$order['members_id'];//获取会员id

            $member=DI()->notorm->members->where('id',$member_id)->fetchOne();//根据会员id查会员信息

            $level=$member['level'];//获取会员等级

            if($level>1){//等级>1为代理，需分配库存，再记录明细

                //2).插入库存明细inventroy_record总部出库
                $this->insertTotalInventoryRecord($order,$member,$product);

                //3).插入库存明细inventroy_record代理入库
                $this->insertAgentInventoryRecord($order,$member);

                //4).插入代理库存表agent_inventory中(判断是该代理是a否有该商品的数据，有则修改数量，无则新增)
                $this->insertAgent($order,$member);

            }else if($level==1){//等级等于1则直接扣总部库存

                //2).插入库存明细inventroy_record总部出库
                $this->insertTotalInventoryRecord($order,$member,$product);
            }
//            //Step 3: 提交事务
//            DI()->notorm->commit('db_daili');

            return true;

        }catch (Exception $e){

            DI() -> logger -> error('插入库存记录失败 ',$e);

//            // 回滚
//            DI()->notorm->rollback('db_daili');

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
    public function insertTotalInventoryRecord($order,$member,$product){

        $info=array(
            'product_id' => $order['product_id'],//商品id
            'member_id' => $order['members_id'],//会员id
            'name' =>$member['name'],//会员真实姓名
            'state' => '1',//出库，入库(1出库   2入库)
            'date_added' => date("Y-m-d H:i:s"),//创建时间
            'before_inventory' => $product['num'],//出入库前库存
            'change_inventory' => $order['commodity_num'],//改变的库存(出入库数量)
            'now_inventory' => $product['num']-$order['commodity_num'],//现在库存
            'total_state' => '1',//总部, 代理(1总部   2代理)
            'remark' => $member['name'].'购买出库',//备注
        );
        return DI()->notorm->inventory_record->insert($info);
    }

    /**
     * @param $order
     * @param $member
     * @param $product
     * @return mixed
     * 添加代理入库记录
     */
    public function insertAgentInventoryRecord($order,$member){

        $rs=DI()->notorm->agent_inventory
            ->where(array('product_id'=>$order['product_id'],'member_id'=>$order['members_id']))->fetchOne();

        $info=array(
            'product_id' => $order['product_id'],//商品id
            'member_id' => $order['members_id'],//会员id
            'name' =>$member['name'],//会员真实姓名
            'state' => '2',//出库，入库(1出库   2入库)
            'date_added' => date("Y-m-d H:i:s"),//创建时间
            'before_inventory' => $rs?$rs['inventory_num']:0,//出入库前库存
            'change_inventory' => $order['commodity_num'],//改变的库存(出入库数量)
            'now_inventory' => $rs?$rs['inventory_num']+$order['commodity_num']:$order['commodity_num'],//现在库存
            'total_state' => '2',//总部, 代理(1总部   2代理)
            'remark' => $member['name'].'购买入库',//备注
        );
        return DI()->notorm->inventory_record->insert($info);
    }

    /**
     * @param $order
     * @param $member  会员信息
     * 插入代理库存表
     */
    public function insertAgent($order,$member){

        $product_id=$order['product_id'];//商品id

        $member_id=$order['members_id'];//会员id
        //查找该代理的某个商品的数量
        $rs=DI()->notorm->agent_inventory->where(array('product_id'=>$product_id,'member_id'=>$member_id))->fetchOne();

        if($rs){//存在则修改数量
            //现有数量=原有数量+购买数量
            $nownum=$rs['inventory_num']+$order['commodity_num'];

            return DI()->notorm->agent_inventory->where(array('product_id'=>$product_id,'member_id'=>$member_id))->update(array('inventory_num'=>$nownum));

        }else{//不存在则新增

            $info=array(
                'product_id' => $product_id,
                'member_id' => $member_id,
                'name' =>$member['name'],
                'inventory_num' => $order['commodity_num'],
                'create_time' => date("Y-m-d H:i:s"),
            );
            return DI()->notorm->agent_inventory->insert($info);

        }
    }




    /**
     * 商品订单生成后统计并记录返现相关内容
     */
    public  function  recordCashBackOrder($orderid){
        try{
            //通过商品订单id获取订单详情
            $order=DI()->notorm->commodity_order->where(array('id'=>$orderid,))->fetchOne();
            //获取下单用户信息通过商品订单查询拿到会员id
            $members=DI()->notorm->members->where(array('id'=>$order['members_id'],))->fetchOne();

            //查询该用户是否存在推荐人
            if($members['referee_phone']){
                //获取推荐人相关信息(上级)
                $referee=DI()->notorm->members->where(array('phone'=>$members['referee_phone'],"flag" => 1))->fetchOne();
                //获取代理商返现比例
                $cp=DI()->notorm->cashback_percentage->where(array('level'=>$referee['level'],))->fetchOne();
                $cashback_percentage=$cp['cashback_percentage'];

                $arr=array();

                $arr['member_id']=$members['id'];

                $arr['referee_id']=$referee['id'];

                $arr['member_name']=$members['name'];

                $arr['member_level']=$members['level'];

                $arr['member_price']=$members['level_price'];

                $arr['referee_id']=$referee['id'];

                $arr['referee_name']=$referee['name'];

                $arr['referee_level']=$referee['level'];

                $arr['commodity_name']=$order['commodity_name'];

                $arr['record_date']=date("Y-m",time());//记录时间

                $arr['member_price']=$members['level_price'];
                 //訂單id
                $arr['order_id']=$orderid;
                //订单价格
                $arr['order_price']=$order['commodity_price']*$order['commodity_num'];

                //$arr['same_month']=$order['commodity_num']*100;
                //如果购买商品用户为普通会员
                if($members['level']==1){
                    //获取会员等级为普通会员的返现固定金额
                    $membercp=DI()->notorm->cashback_percentage->where(array('level'=>$members['level'],))->fetchOne();

                    $arr['cashback_percentage']=$cashback_percentage;//返现价格

                    $arr['final_cashback_amount']=$membercp['cashback_price']*$order['commodity_num'].'';

                    $arr['same_month']=$arr['final_cashback_amount']*0.7.'';//当月应返现

                    $arr['next_month']=$arr['final_cashback_amount']*0.3    .'';//下月结余


                }else{

                    $arr['cashback_percentage']=$cashback_percentage.'';//返现比例

                    $arr['final_cashback_amount']=$order['commodity_price']*$order['commodity_num']*$cashback_percentage.'';

                    $arr['same_month']=$arr['final_cashback_amount']*0.7.'';//当月应返现

                    $arr['next_month']=$arr['final_cashback_amount']*0.3.'';//下月结余


                }
                $arr['type']='商品订单返现记录';//记录来源类型

                $arr['registration_date']=date("Y-m-d H:i:s",time());//下级注册时间或商品订单下单时间

                DI()->notorm->cash_record->insert($arr);

                //统计商品订单信息并计算返现金额记录到cash_month_record表中
                $current=date("Y-m",time());//获取当前年月

                $cashmonth=DI()->notorm->cash_month_record->where(array('cash_time'=>$current,'cash_id'=>$referee['id']))->fetchOne();

                if($cashmonth){
                    //已有记录情况下获取到已有返现费用+商品订单返现费用并更新
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



            }else{
                return false;
            }

        }catch (Exception $e){
            DI() -> logger -> error('商品订单返现明细记录id值: '.$orderid+'插入失败',$e);

            return false;
        }


    }

}









