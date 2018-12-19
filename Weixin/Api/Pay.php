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
                'balance_pay'=>array('name' => 'balance_pay','require' => true,'type'=>'string','source' => 'post','desc'=>'余额支付'),
                'cash_pay'=>array('name' => 'cash_pay','require' => true,'type'=>'string','source' => 'post','desc'=>'现金支付'),

            ),
            'rePay'=>array(
                'session3rd'=>array('name' => 'session3rd','require' => true,'type'=>'string','source' => 'post','desc'=>'session'),
                'pay_id'=>array('name' => 'pay_id','require' => true,'type'=>'string','source' => 'post','desc'=>'订单payId'),

            )

        );
	}







	public function addOrder(){

        $rs = array('code' => 0, 'msg' => '', 'info' => array(),'pay_id'=>'');


       // 获取对应的支付引擎
        DI()->pay->set('wechat');

        $session = DI()->wechatMini->getSession($this->session3rd);

        DI()->logger->debug("session: ",array("session3rd"=>$session));

        $data = array();

        $data['pay_id'] = DI()->pay->createOrderNo();

        $data['openid'] = $session['openid'];
        $data['pay'] = Common_OrderStatus::ORDER_STATUS_0;
        $data['total'] = $this -> total;

      	$data['shipping_address'] = $this -> shipping_address;
        $data['receiver_name'] = $this -> receiver_name;
        $data['receiver_phone'] = $this -> receiver_phone;
        $data['province_name'] = $this -> province_name;
        $data['balance_pay'] = $this -> balance_pay;
        $data['cash_pay'] = $this -> cash_pay;

        $data['status'] = 0;

		$data['create_time'] = date('Y-m-d H:i:s',time());

        $domain = new Domain_Pay();

        $products=json_decode($this->products,true);

        $result = $domain->addOrder($data,$products);

        if($result){

            $rs['code'] = 1;
            $rs['msg'] ='会员订单成功并且获取统一订单成功';
            $rs['info'] = $result;
            $rs['pay_id']=$data['pay_id'];
        }else{

            $rs['msg'] ='生成会员订单失败';
        }

        return $rs;

    }

    /**
     * 订单重新支付
     */
    public function rePay(){
        $rs = array('code' => 0, 'msg' => '', 'info' => array());

        $pay_id=$this->pay_id;
        // 获取对应的支付引擎
        DI()->pay->set('wechat');

        $session = DI()->wechatMini->getSession($this->session3rd);

        $openid = $session['openid'];

        $order=DI()->notorm->order->where('pay_id',$pay_id)->fetchOne();

        $domain = new Domain_Pay();
        $result = $domain->rePay($order);
        if($result){

            $rs['code'] = 1;
            $rs['msg'] ='重新支付下单成功';
            $rs['info'] = $result;
        }else{

            $rs['msg'] ='生成会员订单失败';
        }

        return $rs;

    }
  




}