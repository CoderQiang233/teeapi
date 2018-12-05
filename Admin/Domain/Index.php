<?php

/**
 * Created by PhpStorm.
 * User: lxl
 * Date: 2018/7/17
 * Time: 下午3:37
 */
class Domain_Index
{



    //获取订单总数
    public function  getProductOrderCount(){
        $rs = array();

        $model = new Model_Index();

        return $model->getProductOrderCount();
    }

    //获取各省订单总数
    public function  getProductOrderProvince(){
        $rs = array();

        $model = new Model_Index();

        return $model->getProductOrderProvince();
    }

    //获取最新6条订单
    public function  getProductOrderNewest(){
        $rs = array();

        $model = new Model_Index();

        return $model->getProductOrderNewest();
    }


}