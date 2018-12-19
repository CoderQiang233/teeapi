<?php

/**
 * 我的订单
 *
 * @author: dogstar <chanzonghuang@gmail.com> 2014-10-04
 */
class Api_ProductOrder  extends PhalApi_Api{


    public function getRules() {
        return array(

            'findProductOrder' => array(
                'pay' 	=> array('name' => 'pay', 'type' =>'string', 'require' => true,'desc'=>'支付状态'),
                'member_id' 	=> array('name' => 'member_id', 'type' =>'string', 'require' => true,'desc'=>'会员id'),
            ),
            'findAllProductOrder' => array(
                'member_id' 	=> array('name' => 'member_id', 'type' =>'string', 'require' => true,'desc'=>'会员id'),
            ),
            'findProductOrderById' => array(
                'order_id' 	=> array('name' => 'order_id', 'type' =>'string', 'require' => true,'desc'=>'order_id'),
            ),
            'deleteProductOrderById' => array(
                'product_order_id' 	=> array('name' => 'product_order_id', 'type' =>'string', 'require' => true,'desc'=>'id'),
            ),
            'confirmReceipt' => array(
                'order_id' 	=> array('name' => 'order_id', 'type' =>'string', 'require' => true,'desc'=>'id'),
            ),
            'GetOrderBySession' => array(
                'session3rd' =>array('name'=>'session3rd','type' =>'string','require' => true,'source' => 'post','desc'=>'session3rd'),
                'status'=>array('name'=>'status','type' =>'string','require' => false,'source' => 'post','desc'=>'status')
                ),

        );
    }


    /**
     * 通过支付状态查看会员订单信息
     */
    public function findProductOrder(){

        $rs = array('code' => 0, 'msg' => '', 'info' => array());

        $domain = new Domain_ProductOrder();

        $result = $domain -> findProductOrder($this);

        if(is_array($result)){

            $rs['code'] = 1;

            $rs['info'] = $result;

        }

        return $rs;

    }


    /**
     * 通过会员id查看全部会员订单信息
     */
    public function findAllProductOrder(){

        $rs = array('code' => 0, 'msg' => '', 'info' => array());

        $domain = new Domain_ProductOrder();

        $result = $domain -> findAllProductOrder($this);

        if(is_array($result)){

            $rs['code'] = 1;

            $rs['info'] = $result;

        }

        return $rs;
    }

    /**
     * 通过会员session查看全部会员订单信息
     */
    public function GetOrderBySession(){

        $rs = array('code' => 0, 'msg' => '', 'info' => array());

        $domain = new Domain_ProductOrder();

        $session = DI()->wechatMini->getSession($this->session3rd);

        $this->openid=$session['openid'];

        $result = $domain -> GetOrderBySession($this);

        if($result){

            $rs['code'] = 1;

            $rs['info'] = $result;

        }

        return $rs;
    }


    /**
     * 通过id查看订单信息
     */
    public function findProductOrderById(){

        $rs = array('code' => 0, 'msg' => '', 'info' => array());

        $domain = new Domain_ProductOrder();

        $result = $domain -> findProductOrderById($this);

        if(is_array($result)){

            $rs['code'] = 1;

            $rs['info'] = $result;
        }

        return $rs;
    }


    /**
     * 通过id删除订单信息
     */
    public function deleteProductOrderById(){

        $rs = array('code' => 0, 'msg' => '', 'info' => array());

        $domain = new Domain_ProductOrder();

        $result = $domain -> deleteProductOrderById($this);

        if($result){

            $rs['code'] = 1;

            $rs['info'] = $result;
        }

        return $rs;
    }


    /**
     * 确认收货
     */
    public function confirmReceipt(){

        $rs = array('code' => 0, 'msg' => '', 'info' => array());

        $domain = new Domain_ProductOrder();

        $result = $domain -> confirmReceipt($this);

        if($result){

            $rs['code'] = 1;

            $rs['info'] = $result;
        }

        return $rs;
    }


   

}