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
                'shipping_address'=>array('name' => 'shipping_address','require' => true,'type'=>'string','source' => 'post','desc'=>'商品名称'),
                'product_id'=>array('name' => 'product_id','require' => true,'type'=>'string','source' => 'post','desc'=>'商品名称'),
                'session3rd'=>array('name' => 'session3rd','require' => true,'type'=>'string','source' => 'post','desc'=>'商品名称'),
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

//        $data['product_name'] = $this -> product_name;
//
//        $data['product_price'] = $this -> product_price;
//
//        $data['product_num'] = $this -> product_num;

        $data['openid'] = $session['openid'];

        $data['pay'] = 0;

      	$data['shipping_address'] = $this -> shipping_address;

//      	$data['ship_status'] = 0;

//        $data['product_id'] = $this -> product_id;

        $data['status'] = 0;

		$data['create_time'] = date('Y-m-d H:i:s',time());

        $domain = new Domain_Pay();

        $result = $domain->addOrder($data);

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