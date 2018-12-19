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



    public function addOrder($data,$products){

        $pay = new Model_Pay();



            if($pay ->addOrder($data,$products)){

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

//        $money=$_data['cash_pay'];
        $money=0.01;
        $data = array();
        $data['order_no'] = $_data['pay_id'];
        $data['title'] = '';
        $data['body'] = '福玉茶叶';
        $data['price'] = $money;
        $data['openid'] = $_data['openid'];
        return DI()->pay->buildRequestForm($data);
    }
  

  


}