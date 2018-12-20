<?php

/**
 * Created by PhpStorm.
 * User: lxl
 * Date: 2018/7/17
 * Time: 下午3:37
 */
class Domain_ProductOrder
{



    //获取所有商品订单列表
    public function  getProductOrderList($data){
        $rs = array();

        $model = new Model_ProductOrder();

        $rs = $model->getProductOrderList($data);

        return $rs;
    }



    //通过订单id获取订单详情
    public function  getById($id){

        $rs = array();

        $model = new Model_ProductOrder();

        $rs = $model->getById($id);

        return $rs;
    }

    //发货
    public function  shipments($data){

        $rs = array();

        $model = new Model_ProductOrder();

        $rs = $model->shipments($data);

        return $rs;
    }
}