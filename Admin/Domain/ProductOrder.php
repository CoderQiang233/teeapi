<?php

/**
 * Created by PhpStorm.
 * User: lxl
 * Date: 2018/7/17
 * Time: 下午3:37
 */
class Domain_ProductOrder
{



    //获取所有商品订单列表
    public function  getProductOrderList($data){
        $rs = array();

        $model = new Model_ProductOrder();

        $rs = $model->getProductOrderList($data);

        return array(
            'orderAll' => $rs['orderAll'],
            'total' =>$rs['total'],
            'pageIndex' => $rs['pageIndex'],
        );


    }

    public function orderPay($data){

        $model = new Model_ProductOrder();

        if($model ->orderPay($data)){

            return $this->unifiedOrder($data);

        }else{
            return false;
        }

    }

    /**
     * 支付接口
     * @return [type] [description]
     */
    private function unifiedOrder($_data){

        $data = array();
        $data['order_no'] = $_data->id;
        $data['title'] = '';
        $data['body'] = '志梨国际-商品结算';
        $data['price'] = $_data->level_price;
        $data['openid'] = $_data->openId;
        $data['notify_url'] = 'https://testzlgj.zgftlm.com/Public/pay/wechat/notify1.php';
        return DI()->pay->buildRequestForm($data);
    }
    public function getProductOrderById($id){


        $model = new Model_ProductOrder();

        return $model -> getProductOrderById($id);

    }

    //通过订单id获取订单详情
    public function  getById($id){

        $rs = array();

        $model = new Model_ProductOrder();

        $rs = $model->getById($id);

        return $rs;
    }

    //发货
    public function  shipments($data){

        $rs = array();

        $model = new Model_ProductOrder();

        $rs = $model->shipments($data);

        return $rs;
    }
}