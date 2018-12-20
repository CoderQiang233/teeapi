<?php

/**
 * 商品订单列表API
 *
 * @author: dogstar <chanzonghuang@gmail.com> 2014-10-04
 */
class Api_ProductOrder  extends PhalApi_Api{


    public function getRules() {
        return array(

            'getProductOrderList'=> array(
                'pay' => array('name' => 'pay', 'type' => 'string',  'desc' => '订单状态'),
                'pay_id' => array('name' => 'pay_id', 'type' => 'string',  'desc' => '微信支付编号'),
                'nick_name' => array('name' => 'nick_name', 'type' => 'string',  'desc' => '会员昵称'),
                'updatedAt' => array('name' => 'updatedAt', 'type' => 'string',  'desc' => '订单创建时间'),
                'pageSize'=> array('name' => 'pageSize',  'type' => 'int', 'require' => true, 'desc' => '每页条数'),
                'pageIndex'=> array('name' => 'pageIndex', 'type' => 'int', 'require' => true,  'desc' => '跳转页码'),
            ),
            'getById' => array(
                'id' 	=> array('name' => 'id', 'require' => true ,'desc' => '商品订单id'),
            ),
            'shipments' => array(
                'order_id' 	=> array('name' => 'order_id', 'require' => true ,'desc' => '订单id'),
                'express_id' 	=> array('name' => 'express_id', 'desc' => '发货信息id'),
                'express_number' 	=> array('name' => 'express_number', 'require' => true ,'desc' => '快递单号'),
                'express_name' 	=> array('name' => 'express_name', 'require' => true ,'desc' => '快递名称'),
                'ship_time' 	=> array('name' => 'ship_time', 'require' => true ,'desc' => '发货时间'),
//                'status' 	=> array('name' => 'status','desc' => '状态(0:发货,1:退货)'),
                'userName'=> array('name' => 'userName', 'type' => 'string',   'desc' => '操作人用户号'),
                'user_name'=> array('name' => 'user_name', 'type' => 'string',   'desc' => '操作人真实姓名'),
            ),
        );
    }



    /**
     * 获取所有订单列表
     * @desc获取所有订单列表
     */
    public function getProductOrderList(){

        $rs = array('code' => 0, 'msg' => '', 'info' => array());

        $domain = new Domain_ProductOrder();

        $result = $domain->getProductOrderList($this);

        if($result){

            $rs['code'] = 1;

            $rs['info'] = $result;

        }

        return $rs;
    }


    /**
     * 通过订单id获取订单详情
     * @desc通过订单id获取订单详情
     */
    public function getById(){

        $rs = array('code' => 0, 'msg' => '', 'info' => array());

        $domain = new Domain_ProductOrder();

        $result = $domain->getById($this->id);
  
        if($result){

            $rs['code'] = 1;

            $rs['info'] = $result;

        }

        return $rs;
    }

    /**
     * 发货
     * @desc发货详情
     */
    public function shipments(){

        $rs = array('code' => 0, 'msg' => '', 'info' => array());

        $domain = new Domain_ProductOrder();

        $result = $domain->shipments($this);

        if($result){

            $rs['code'] = 1;

            $rs['info'] = $result;

        }

        return $rs;
    }



}