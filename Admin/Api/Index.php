<?php

/**
 * 首页统计
 *
 * @author: dogstar <chanzonghuang@gmail.com> 2014-10-04
 */
class Api_Index  extends PhalApi_Api{


    public function getRules() {
        return array(

            'getProductOrderNewest'=> array(),

            'getProductOrderProvince'=> array(),
        );
    }


    /**
     * 获取订单总数,总销售额，总客户数
     * @desc获取订单总数,总销售额，总客户数
     */
    public function getProductOrderCount(){

        $rs = array('code' => 0, 'msg' => '', 'info' => array());

        $domain = new Domain_Index();

        $result = $domain->getProductOrderCount();

        if($result){

            $rs['code'] = 1;

            $rs['info'] = $result;

        }

        return $rs;
    }

    /**
     * 获取各省订单总数,总销售额，总客户数
     * @desc获取各省订单总数,总销售额，总客户数
     */
    public function getProductOrderProvince(){

        $rs = array('code' => 0, 'msg' => '', 'info' => array());

        $domain = new Domain_Index();

        $result = $domain->getProductOrderProvince();

        if($result){

            $rs['code'] = 1;

            $rs['info'] = $result;

        }

        return $rs;
    }


    /**
     * 获取最新6条订单
     * @desc获取最新6条订单
     */
    public function getProductOrderNewest(){

        $rs = array('code' => 0, 'msg' => '', 'info' => array());

        $domain = new Domain_Index();

        $result = $domain->getProductOrderNewest();

        if($result){

            $rs['code'] = 1;

            $rs['info'] = $result;

        }

        return $rs;
    }


}