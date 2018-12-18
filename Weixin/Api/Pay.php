<?php
/**
 * 支付API
 *
 * @author: dogstar <chanzonghuang@gmail.com> 2014-10-04
 */
class Api_Pay extends PhalApi_Api {

	public function getRules() {
        return array(

            'addOrder' => array(
                'shipping_address'=>array('name' => 'shipping_address','require' => true,'type'=>'string','source' => 'post','desc'=>'收货地址'),
                'products'=>array('name' => 'products','require' => true,'type'=>'string','source' => 'post','desc'=>'商品id'),
                'session3rd'=>array('name' => 'session3rd','require' => true,'type'=>'string','source' => 'post','desc'=>'session'),
                'total'=>array('name' => 'total','require' => true,'type'=>'string','source' => 'post','desc'=>'商品总额'),
                'receiver_name'=>array('name' => 'receiver_name','require' => true,'type'=>'string','source' => 'post','desc'=>'收货人姓名'),
                'receiver_phone'=>array('name' => 'receiver_phone','require' => true,'type'=>'string','source' => 'post','desc'=>'收货人电话'),
                'province_name'=>array('name' => 'province_name','require' => true,'type'=>'string','source' => 'post','desc'=>'省名'),

            ),

        );
	}







	public function addOrder(){

        $rs = array('code' => 0, 'msg' => '', 'info' => array());


       // 获取对应的支付引擎
        DI()->pay->set('wechat');

        $session = DI()->wechatMini->getSession($this->session3rd);

        DI()->logger->debug("session: ",array("session3rd"=>$session));

        $data = array();

        $data['pay_id'] = DI()->pay->createOrderNo();

        $data['openid'] = $session['openid'];

        $data['pay'] = OrderStatus::ORDER_STATUS_0;
        $data['total'] = $this -> total;

      	$data['shipping_address'] = $this -> shipping_address;
        $data['receiver_name'] = $this -> receiver_name;
        $data['receiver_phone'] = $this -> receiver_phone;
        $data['province_name'] = $this -> province_name;

        $data['status'] = 0;

		$data['create_time'] = date('Y-m-d H:i:s',time());

        $domain = new Domain_Pay();

        $products=json_decode($this->products,true);

        $result = $domain->addOrder($data,$products);

        if($result){

            $rs['code'] = 1;
            $rs['msg'] ='会员订单成功并且获取统一订单成功';
            $rs['info'] = $result;
        }else{

            $rs['msg'] ='生成会员订单失败';
        }

        return $rs;

    }
  




}