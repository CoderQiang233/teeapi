<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/10/10 0010
 * Time: 下午 3:01
 */
class Model_delegateQuery{

    public  function  getResult($order_id){

        if (strlen($order_id)==11){
            return DI() ->notorm->members->select('*')->where('phone = ?', $order_id)->fetch();
        }else{
            return DI() ->notorm->members->select('*')->where('authorization_number = ?', $order_id)->fetch();
        }

    }
}