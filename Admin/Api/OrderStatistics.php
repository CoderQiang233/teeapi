<?php
/**
 * 订单统计
 * Created by PhpStorm.
 * User: ${zhouyuan}
 * Date: 2018/11/7
 * Time: 14:33
 */



class Api_OrderStatistics  extends PhalApi_Api{


    public function getRules() {
        return array(
            'getlist'=> array(
                'member_name' => array('name' => 'member_name', 'type' => 'string',  'desc' => '会员名称'),
                'datestart' => array('name' => 'datestart', 'type' => 'string',  'desc' => '开始时间'),
                'dateend' => array('name' => 'dateend', 'type' => 'string',  'desc' => '结束时间'),
            ),

        );
    }


    /**
     * 获取订单统计信息列表
     * @desc  获取订单统计信息列表
     */
    public function getlist(){

        $rs = array('code' => 0, 'msg' => '', 'info' => array());

        $product = new Domain_OrderStatistics();

        $result = $product->getlist($this);

        if($result){

            $rs['code'] = 1;

            $rs['info'] = $result;
        }

        return $rs;

    }




}