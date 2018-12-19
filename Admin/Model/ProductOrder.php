<?php

/**
 * Created by PhpStorm.
 * User: lxl
 * Date: 2018/7/17
 * Time: 下午3:38
 */
class Model_ProductOrder extends PhalApi_Model_NotORM
{


    //获取所有商品订单列表
    public function getProductOrderList($data){

        $where='';

        $pageSize='';//每页条数

        $pageIndex='';//当前页

        $pay_id=$data->pay_id;//订单编号

        $name=$data->name;//会员姓名

        $updatedAt=$data->updatedAt;//订单创建时间

        $ship_status=$data->ship_status;//发货状态

        if('undefined' !==$pay_id  && '' !== $pay_id && null !== $pay_id ){

            $where=$where." AND o.pay_id='".$pay_id."'";
        }

        if('undefined' !==$name  && '' !== $name && null !== $name ){

            $where=$where." AND m.name='".$name."'";
        }

        if('undefined' !==$ship_status  && '' !== $ship_status && null !== $ship_status ){

            $where=$where." AND o.ship_status='".$ship_status."'";
        }

        if('undefined' !==$updatedAt  && '' !== $updatedAt && null !== $updatedAt ){

            $updatedAt=strtotime($updatedAt);//选择时间
            //选择时间的开始时间
            $updatedAt_S= mktime(0,0,0,date("m",$updatedAt),date("d",$updatedAt),date("Y",$updatedAt));
            //选择时间的结束时间
            $updatedAt_A=mktime(23,59,59,date("m",$updatedAt),date("d",$updatedAt),date("Y",$updatedAt));

            $where = $where." AND o.update_date between ".$updatedAt_S." AND ".$updatedAt_A;
        }

        if('undefined' !== $data->pageSize && '' !== $data->pageSize && null !== $data->pageSize ){

            $pageSize=$data->pageSize;

        }

        if('undefined' !== $data->pageIndex && '' !== $data->pageIndex && null !== $data->pageIndex ){

            $pageIndex=$data->pageIndex;

        }

        $start_page=$pageSize*($pageIndex-1);

        $params = array(':pageSize' => $pageSize,':start_page' => $start_page);

        $sql = 'SELECT o.*,m.nick_name '
            . 'FROM shop_order AS o LEFT JOIN shop_members AS m '
            . 'ON o.member_id=m.id WHERE o.pay>0 and o.status=0  '
            . $where
            .' order by o.order_id desc  limit :start_page,:pageSize ';

        $sqls = 'SELECT o.*,m.nick_name '
            . 'FROM shop_order AS o LEFT JOIN shop_members AS m '
            . 'ON o.member_id=m.id WHERE o.pay>0 and o.status=0 '
            . $where;

        $orderAll= DI()->notorm->order->queryAll($sql,$params);

//        for($i=0;$i<count($orderAll);$i++){
//            $order=$orderAll[$i];
//            //总的发货数量
//            $shipnum=DI()->notorm->product_express->where('order_id',$order['order_id'])->sum('ship_num');
//            $orderAll[$i]['shipnum']=$shipnum==null?0:$shipnum;
//        }

        $total = count(DI()->notorm->order->queryAll($sqls));

        return array(
            'orderAll' => $orderAll,
            'total' => $total,
            'pageIndex' => $pageIndex,
        );

    }
    public function orderPay($data){

        try{

            $info=array(
                'commodity_name' => $data->commodityName,
                'commodity_price' => $data->commodityPrice,
                'commodity_num' => $data->commodityNum,
                'members_id' => $data->membersId,
                'pay' => 0,
                'create_time' => date("Y-m-d H:i:s"),
                'openid' => $data->openId,
                'order_id' => $data->id,
                'shipping_address' => $data->shippingAddress,
            );
            DI()->notorm->commodity_order->insert($info);

            return true;

        }catch (Exception $e){

            DI()->logger->log('payProductOrder','插入订单失败',$e);
            return false;
        }

    }
    public function getProductOrderById($id){

        return DI()->notorm->commodity_order->where('members_id',$id)->fetchAll();

    }

    public function getById($id){

        try{

            $params = array(':id' => $id);

            $sql = 'SELECT o.*,m.name,m.phone  '
                . 'FROM commodity_order AS o LEFT JOIN members AS m '
                . 'ON o.members_id=m.id WHERE o.id=:id ';

            $order= DI()->notorm->commodity_order->queryAll($sql,$params);

            $express=DI()->notorm->commodity_express->where('order_id',$id)->order('id')->fetchAll();

            $shipnum=DI()->notorm->commodity_express->where('order_id',$id)->sum('ship_num');

            $order[0]['shipnum']=$shipnum;

            if(count($express)>0){

                $order[0]['express']=$express;
            }
            return $order[0];

        }catch (Exception $e){

            DI()->logger->log('findProductOrder','查找商品订单失败id:'.$id,$e);

            return false;

        }


    }

    //发货
    public function shipments($data){

        try{

            //存在发货信息id更新
            if('undefined' !== $data->express_id && '' !== $data->express_id && null !== $data->express_id ){

                $infoupdatae=array(
                    'express_number' => $data->express_number,
                    'express_name' => $data->express_name,
                    'ship_time' => $data->ship_time,
//                    'ship_num' => $data->ship_num,
//                    'status' => $data->status,
                );

                DI()->notorm->commodity_express->where('id', $data->express_id)->update($infoupdatae);

            }else{//不存在插入

                //插入订单快递表
                $info=array(
                    'order_id' => $data->order_id,
                    'express_number' => $data->express_number,
                    'express_name' => $data->express_name,
                    'ship_time' =>$data->ship_time,
                    'ship_num' => $data->status=='0'? $data->ship_num:-($data->ship_num),
                    'status' => $data->status,//发货状态(0:发货,1:退货)
                    'create_time'=>date("Y-m-d H:i:s"),
                    'userName' => $data->userName,
                    'user_name'=>$data->user_name,
                );
                //Step 1: 开启事务
                DI()->notorm->beginTransaction('db_daili');
                //1)插入商品订单表
                DI()->notorm->commodity_express->insert($info);
                //修改发货状态
                $ship_status = array('ship_status' => 1);
                //2)修改发货状态
                DI()->notorm->commodity_order->where('id', $data->order_id)->update($ship_status);
                //通过订单Id查询该条订单
                $order=DI()->notorm->commodity_order->where('id',$data->order_id)->fetchOne();
                //根据会员id查会员信息
                $member=DI()->notorm->members->where('id',$order['members_id'])->fetchOne();
                //3)发货且是代理 1.扣代理库存 2.插入库存明细
                if($data->status=='0'&&$member['level']>1){

                    $this->agentShipOperation($order,$member,$data);
                }else if($data->status=='1'&&$member['level']>1){//退货是代理  1.加代理库存 2.插入库存明细

                    $this->agentReturnOperation($order,$member,$data);
                }else if($data->status=='1'&&$member['level']==1){//退货不是代理	 1.加总部库存 2.插入库存明细

                    $this->headReturnOperation($order,$member,$data);
                }
                //Step 3: 提交事务
                DI()->notorm->commit('db_daili');
            }

            return true;

        }catch (Exception $e){

            DI()->logger->log('shipments','增加快递信息失败',$e);

            // 回滚
            DI()->notorm->rollback('db_daili');

            return false;

        }
    }

    /**
     * @param $order
     * @param $member
     * @param $data
     * 1.插入库存明细 2.扣代理库存
     * 发货且是代理
     */
    public function agentShipOperation($order,$member,$data){

        //1)插入库存明细,代理出库
        $rs=DI()->notorm->agent_inventory
            ->where(array('product_id'=>$order['product_id'],'member_id'=>$order['members_id']))->fetchOne();
        //实际库存=原有库存-发货库存
        $now=$rs['inventory_num']- $data->ship_num;
        $info=array(
            'product_id' => $order['product_id'],//商品id
            'member_id' => $order['members_id'],//会员id
            'name' =>$member['name'],//会员真实姓名
            'state' => '1',//出库，入库(1出库   2入库)
            'date_added' => date("Y-m-d H:i:s"),//创建时间
            'before_inventory' => $rs['inventory_num'],//出入库前库存
            'change_inventory' => $data->ship_num,//改变的库存(出入库数量)
            'now_inventory' =>$now,//现在库存
            'total_state' => '2',//总部, 代理(1总部   2代理)
            'remark' => $member['name'].'发货出库',//备注
            'userName' => $data->userName,
            'user_name'=>$data->user_name,
        );
        DI()->notorm->inventory_record->insert($info);
        //2)扣除代理库存
        return DI()->notorm->agent_inventory->where(array('product_id'=>$order['product_id'],'member_id'=>$order['members_id']))->update(array('inventory_num'=>$now));
    }

    /**
     * @param $order
     * @param $member
     * @param $data
     * 1.插入库存明细 2.加代理库存
     * 退货且是代理
     */
    public function agentReturnOperation($order,$member,$data){

        //1)插入库存明细,代理入库
        $rs=DI()->notorm->agent_inventory
            ->where(array('product_id'=>$order['product_id'],'member_id'=>$order['members_id']))->fetchOne();
        //实际库存=原有库存+退货库存
        $now=$rs['inventory_num']+$data->ship_num;
        $info=array(
            'product_id' => $order['product_id'],//商品id
            'member_id' => $order['members_id'],//会员id
            'name' =>$member['name'],//会员真实姓名
            'state' => '2',//出库，入库(1出库   2入库)
            'date_added' => date("Y-m-d H:i:s"),//创建时间
            'before_inventory' => $rs['inventory_num'],//出入库前库存
            'change_inventory' => $data->ship_num,//改变的库存(出入库数量)
            'now_inventory' =>$now,//现在库存
            'total_state' => '2',//总部, 代理(1总部   2代理)
            'remark' => $member['name'].'退货入库',//备注
            'userName' => $data->userName,
            'user_name'=>$data->user_name,
        );
        DI()->notorm->inventory_record->insert($info);
        //2)加代理库存
        return DI()->notorm->agent_inventory->where(array('product_id'=>$order['product_id'],'member_id'=>$order['members_id']))->update(array('inventory_num'=>$now));
    }

    /**
     * @param $order
     * @param $member
     * @param $data
     * 1.插入库存明细 2.加总部库存
     * 退货不是代理
     */
    public function headReturnOperation($order,$member,$data){

        //1)插入库存明细,总部入库
        $rs=DI()->notorm->commodity->where('id',$order['product_id'])->fetchOne();
        //实际库存=原有库存+退货库存
        $now=$rs['num']+$data->ship_num;
        $info=array(
            'product_id' => $order['product_id'],//商品id
            'member_id' => $order['members_id'],//会员id
            'name' =>$member['name'],//会员真实姓名
            'state' => '2',//出库，入库(1出库   2入库)
            'date_added' => date("Y-m-d H:i:s"),//创建时间
            'before_inventory' => $rs['num'],//出入库前库存
            'change_inventory' => $data->ship_num,//改变的库存(出入库数量)
            'now_inventory' =>$now,//现在库存
            'total_state' => '1',//总部, 代理(1总部   2代理)
            'remark' => $member['name'].'退货入库',//备注
            'userName' => $data->userName,
            'user_name'=>$data->user_name,
        );
        DI()->notorm->inventory_record->insert($info);
        //2)加总部库存
        return  DI()->notorm->commodity->where('id',$order['product_id'])->update(array('num'=>$now));

    }

}