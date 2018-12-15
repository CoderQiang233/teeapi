<?php

/**
 * 支付订单
 * User: lxl
 * Date: 2018/7/18
 * Time: 下午5:42
 */
class Model_Pay extends PhalApi_Model_NotORM{





    public function addOrder($data){

        try{
            $openid=$data['openid'];
            $members=DI()->notorm->members->where('openid',$openid)->fetchOne();
            $member_id=$members['id'];
            return true;





        }catch (Exception $e){

            DI() -> logger -> error('生成订单失败原因: ',$e);
            return false;

        }

    }





}