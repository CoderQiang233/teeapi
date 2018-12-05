<?php
/**
 * 商品销售统计管理
 * Created by PhpStorm.
 * User: ${zhouyuan}
 * Date: 2018/11/6
 * Time: 11:04
 */



class Api_GoodStatistics  extends PhalApi_Api{


    public function getRules() {
        return array(
            'getlist'=> array(
                'commodity_name' => array('name' => 'commodity_name', 'type' => 'string',  'desc' => '商品名称'),
                'datestart' => array('name' => 'datestart', 'type' => 'string',  'desc' => '开始时间'),
                'dateend' => array('name' => 'dateend', 'type' => 'string',  'desc' => '结束时间'),
            ),

        );
    }


    /**
     * 获取商品销售信息列表
     * @desc  获取商品销售信息列表
     */
    public function getlist(){

        $rs = array('code' => 0, 'msg' => '', 'info' => array());

        $product = new Domain_GoodStatistics();

        $result = $product->getlist($this);

        if($result){

            $rs['code'] = 1;

            $rs['info'] = $result;
        }

        return $rs;

    }




}