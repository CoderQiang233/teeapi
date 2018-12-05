<?php

/**
 * 购买商品API
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
                'province_code'=> array('name' => 'province_code', 'require' => true,'type'=>'string' ,'source' => 'post'),
                'province_name'=> array('name' => 'province_name', 'require' => true,'type'=>'string' ,'source' => 'post'),
                'product_id'=> array('name' => 'product_id', 'require' => true,'source' => 'post','desc'=>'商品id'),
            ),
            'getProductOrderById' => array(
                'id' 	=> array('name' => 'id', 'type' =>'string','require' => true)
            ),
        );
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

            if($result=='warn'){

                $rs['code'] = 2;

                $rs['msg'] ='库存不足';

                return $rs;
            }
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
   

}