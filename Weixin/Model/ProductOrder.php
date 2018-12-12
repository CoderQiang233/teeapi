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
            'WHERE status=0 and o.pay = :pay and o.member_id= :member_id ';

        $params =array(':pay'=>$data->pay,':member_id'=>$data->member_id);

        $rs=DI()->notorm->product_order->queryAll($sql,$params);

        return $rs;
    }

    public  function findAllProductOrder($data){

        $sql='SELECT o.*, p.first_picture '.
            'FROM shop_product_order AS o '.
            'LEFT JOIN shop_product AS p ON o.product_id = p.product_id '.
            'WHERE status=0 and o.member_id= :member_id ';

        $params =array(':member_id'=>$data->member_id);

        $rs=DI()->notorm->product_order->queryAll($sql,$params);

        return $rs;
    }

    public  function findProductOrderById($product_order_id){

        $sql='SELECT o.*, p.first_picture '.
            'FROM shop_product_order AS o '.
            'LEFT JOIN shop_product AS p ON o.product_id = p.product_id '.
            'WHERE status=0 and o.product_order_id= :product_order_id ';

        $params =array(':product_order_id'=>$product_order_id);

        $rs=DI()->notorm->product_order->queryAll($sql,$params);

        return $rs;
    }


    public  function deleteProductOrderById($product_order_id){

       return DI()->notorm->product_order->where('product_order_id',$product_order_id)->update(array('status'=>'1'));
    }
}