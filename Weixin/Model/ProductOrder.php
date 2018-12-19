<?php

/**
 * Created by PhpStorm.
 * User: lxl
 * Date: 2018/7/17
 * Time: 下午3:38
 */
class Model_ProductOrder extends PhalApi_Model_NotORM
{

    public  function findProductOrder($data){

        $sql='SELECT o.*, p.first_picture '.
            'FROM shop_product_order AS o '.
            'LEFT JOIN shop_product AS p ON o.product_id = p.product_id '.
            'WHERE status=0 and o.pay = :pay and o.member_id= :member_id order by o.product_order_id ';

        $params =array(':pay'=>$data->pay,':member_id'=>$data->member_id);

        $rs=DI()->notorm->product_order->queryAll($sql,$params);

        return $rs;
    }

    public  function findAllProductOrder($data){

        $sql='SELECT o.*, p.first_picture '.
            'FROM shop_product_order AS o '.
            'LEFT JOIN shop_product AS p ON o.product_id = p.product_id '.
            'WHERE status=0 and o.member_id= :member_id order by o.product_order_id ';

        $params =array(':member_id'=>$data->member_id);

        $rs=DI()->notorm->order->queryAll($sql,$params);

        return $rs;
    }

    public  function findProductOrderById($order_id){
//
//        $sql='SELECT o.*, p.first_picture '.
//            'FROM shop_product_order AS o '.
//            'LEFT JOIN shop_product AS p ON o.product_id = p.product_id '.
//            'WHERE status=0 and o.product_order_id= :product_order_id ';
//
//        $params =array(':product_order_id'=>$product_order_id);
//
//        $rs=DI()->notorm->order->queryAll($sql,$params);

        return DI()->notorm->order_product->where('order_id',$order_id)->fetchAll();
    }

    public  function GetOrderBySession($openid,$status){
        if($status !=null){
            //return DI()->notorm->order->where('openid',$openid)->where('pay',$status)->fetchAll();
            //$order  获取状态是pay 未删除 的所有订单数组
            $order=DI()->notorm->order->where(array('openid'=>$openid,'pay'=>$status,'status'=>'0'))->fetchAll();
           //$productMessage 获取单条的订单信息,得到单条订单的order_id,通过 order_id,获取单条订单的详情信息
            foreach ($order as $key=> $productMessage){
                $mes= $productMessage['order_id'];

                $order[$key]['product'] =DI()-> notorm->order_product->where('order_id',$mes)->fetchAll();

            }
            return $order;


        }else{
            $order = DI()->notorm->order->where(array('openid'=>$openid,'status'=>'0'))->fetchAll();
             foreach ($order as $key=> $productMessage){
                 $mes= $productMessage['order_id'];
                 $order[$key]['product'] =DI()-> notorm->order_product->where('order_id',$mes)->fetchAll();
             }
            return $order;
        }

    }


    public  function deleteProductOrderById($product_order_id){

       return DI()->notorm->order->where('order_id',$product_order_id)->update(array('status'=>'1'));
    }


    public  function confirmReceipt($order_id){

        $result1=DI()->notorm->order->where('order_id',$order_id)->update(array('pay'=>'3'));
        if($result1){
            $shop_order_product=DI()->notorm->order_product->where(array('order_id'=>$order_id,'promoter is not null'))->fetchAll();
        }
        $money=0;
        if($shop_order_product){
            foreach ($shop_order_product as $s){

                $rs=DI()->notorm->commission_history->where(array('order_product_id'=>$s['order_product_id'],'status'=>0))->fetchOne();
                $id=$rs['member_id'];
                $money+=$rs['total'];
                $member=DI()->notorm->members->where('id',$id)->fetchOne();
                $balance=$member['balance'];
                $money+=$balance;
                $result2=DI()->notorm->members->where('id',$id)->update(array('balance'=>$money));
                $result3=DI()->notorm->commission_history->where(array('order_product_id'=>$s['order_product_id'],'status'=>0))->update(array('status'=>1));

            }
        }

        return $result1;
    }
}