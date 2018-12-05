<?php

/**
 * 商品订单列表API
 *
 * @author: dogstar <chanzonghuang@gmail.com> 2014-10-04
 */
class Api_ProductOrder  extends PhalApi_Api{


    public function getRules() {
        return array(

            'orderPay' => array(
                'commodityName' 	=> array('name' => 'commodityName', 'type' =>'string', 'require' => true),
                'commodityPrice' 	=> array('name' => 'commodityPrice', 'type' =>'string', 'require' => true),
                'commodityNum' 	=> array('name' => 'commodityNum', 'type' =>'string', 'require' => true),
                'membersId' 	=> array('name' => 'membersId', 'type' =>'string', 'require' => true),
                'session3rd'   => array('name' => 'session3rd', 'require' => true,'type'=>'string' ,'source' => 'post'),
                'shippingAddress'   => array('name' => 'shippingAddress', 'require' => true,'type'=>'string' ,'source' => 'post'),
            ),
            'getProductOrderById' => array(
                'id' 	=> array('name' => 'id', 'type' =>'string','require' => true)
            ),
            'getProductOrderList'=> array(
                'ship_status' => array('name' => 'ship_status', 'type' => 'string',  'desc' => '发货状态'),
                'order_id' => array('name' => 'order_id', 'type' => 'string',  'desc' => '订单编号'),
                'name' => array('name' => 'name', 'type' => 'string',  'desc' => '会员姓名'),
                'phone' => array('name' => 'phone', 'type' => 'string',  'desc' => '会员手机号'),
                'updatedAt' => array('name' => 'updatedAt', 'type' => 'string',  'desc' => '订单创建时间'),
                'pageSize'=> array('name' => 'pageSize',  'type' => 'int', 'require' => true, 'desc' => '每页条数'),
                'pageIndex'=> array('name' => 'pageIndex', 'type' => 'int', 'require' => true,  'desc' => '跳转页码'),
            ),
            'getById' => array(
                'id' 	=> array('name' => 'id', 'require' => true ,'desc' => '商品订单id'),
            ),
            'shipments' => array(
                'order_id' 	=> array('name' => 'order_id', 'require' => true ,'desc' => '商品订单id'),
//                'shipList' 	=> array('name' => 'shipList', 'require' => true ,'desc' => '发货信息'),
                'express_id' 	=> array('name' => 'express_id', 'desc' => '发货信息id'),
                'express_number' 	=> array('name' => 'express_number', 'require' => true ,'desc' => '快递单号'),
                'express_name' 	=> array('name' => 'express_name', 'require' => true ,'desc' => '快递名称'),
                'ship_time' 	=> array('name' => 'ship_time', 'require' => true ,'desc' => '发货时间'),
                'ship_num' 	=> array('name' => 'ship_num', 'require' => true ,'desc' => '发/退货数量'),
                'status' 	=> array('name' => 'status','desc' => '状态(0:发货,1:退货)'),
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
     * 购买商品,插入commodity_order表中
     */
    public function orderPay(){

        $rs = array('code' => 0, 'msg' => '', 'info' => array());

        DI()->pay->set('wechat');

        $session = DI()->wechatMini->getSession($this->session3rd);

        DI()->logger->debug("session: ",array("session3rd"=>$session));

        $domain = new Domain_ProductOrder();

        $data=$this;

        $data->id = DI()->pay->createOrderNo();

        $data->openId=$session['openid'];

        $data->level_price =(double)($data->commodityPrice)*(int)($data->commodityNum);

        $result = $domain->orderPay($data);

        if($result){

            $rs['code'] = 1;
            $rs['msg'] ='商品购买成功一订单成功';
            $rs['info'] = $result;
        }else{

            $rs['msg'] ='商品购买失败';
        }

        return $rs;

    }
    /**
     * 获取我的商品订单信息
     */
    public function getProductOrderById(){

        $id = $this -> id;

        $rs = array('code' => 0, 'msg' => '', 'info' => array());

        $domain = new Domain_ProductOrder();

        $result = $domain -> getProductOrderById($id);

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