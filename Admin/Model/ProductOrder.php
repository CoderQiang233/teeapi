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

        $name=$data->nick_name;//会员昵称

        $updatedAt=$data->updatedAt;//订单创建时间

        $pay=$data->pay;//订单状态

        if('undefined' !==$pay_id  && '' !== $pay_id && null !== $pay_id ){

            $where=$where." AND o.pay_id='".$pay_id."'";
        }

        if('undefined' !==$name  && '' !== $name && null !== $name ){

            $where=$where." AND m.nick_name='".$name."'";
        }

        if('undefined' !==$pay  && '' !== $pay && null !== $pay ){

            $where=$where." AND o.pay='".$pay."'";
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

        $params = array(':pageSize' => $pageSize,':start_page' => $start_page,':pay'=>Common_OrderStatus::ORDER_STATUS_0);

        $sql = 'SELECT o.*,m.nick_name '
            . 'FROM shop_order AS o LEFT JOIN shop_members AS m '
            . 'ON o.member_id=m.id WHERE o.pay>:pay and o.status=0  '
            . $where
            .' order by o.order_id desc  limit :start_page,:pageSize ';

        $sqls = 'SELECT o.*,m.nick_name '
            . 'FROM shop_order AS o LEFT JOIN shop_members AS m '
            . 'ON o.member_id=m.id WHERE o.pay>:pay and o.status=0 '
            . $where;

        $orderAll= DI()->notorm->order->queryAll($sql,$params);

        $total = count(DI()->notorm->order->queryAll($sqls,$params));

        return array(
            'orderAll' => $orderAll,
            'total' => $total,
            'pageIndex' => $pageIndex,
        );

    }

    public function getById($id){

        try{

            $order=DI()->notorm->order->where('order_id',$id)->fetchOne();

            $sql='SELECT op.*, p.*  FROM shop_order_product AS op '.
                'LEFT JOIN shop_product AS p ON op.product_id = p.product_id '.
                'where op.order_id=:order_id ';

            $params=array(':order_id'=>$id);

            $products=DI()->notorm->order_product->queryAll($sql,$params);

            $express=DI()->notorm->product_express->where('order_id',$id)->fetchAll();

            $order['products']=$products;

            $order['express']=$express;

            return $order;

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
                );

                DI()->notorm->product_express->where('id', $data->express_id)->update($infoupdatae);

            }else{//不存在插入

                //插入订单快递表
                $info=array(
                    'order_id' => $data->order_id,
                    'express_number' => $data->express_number,
                    'express_name' => $data->express_name,
                    'ship_time' =>$data->ship_time,
                    'status' => '0',//发货状态(0:发货,1:退货)
                    'create_time'=>date("Y-m-d H:i:s"),
                    'userName' => $data->userName,
                    'user_name'=>$data->user_name,
                );
                //1)插入商品订单表
                DI()->notorm->product_express->insert($info);
                //修改订单状态
                $ship_status = array('pay' => 2);
                //2)修改订单状态
                DI()->notorm->order->where('order_id', $data->order_id)->update($ship_status);

            }

            return true;

        }catch (Exception $e){

            DI()->logger->log('shipments','添加快递信息失败',$e);

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