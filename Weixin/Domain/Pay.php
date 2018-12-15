<?php

/**
 * Created by PhpStorm.
 * User: lxl
 * Date: 2018/7/18
 * Time: 下午3:21
 */
class Domain_Pay
{
    const ORDER_STATUS_0 = 0; // 未支付

    const ORDER_STATUS_1 = 1; // 已支付



    public function addOrder($data){

        $pay = new Model_Pay();



            if($pay ->addOrder($data)){

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

        $money=$_data['product_price']*$_data['product_num'];
        $data = array();
        $data['order_no'] = $_data['order_id'];
        $data['title'] = '';
        $data['body'] = '志梨国际-会费结算';
        $data['price'] = $money;
        $data['openid'] = $_data['openid'];
        return DI()->pay->buildRequestForm($data);
    }
  

  


}