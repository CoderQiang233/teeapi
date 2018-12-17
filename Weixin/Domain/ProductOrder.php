<?php

/**
 * Created by PhpStorm.
 * User: lxl
 * Date: 2018/7/17
 * Time: 下午3:37
 */
class Domain_ProductOrder
{

    public function findProductOrder($data){

        try{

            $model=new Model_ProductOrder();

            $res=$model->findProductOrder($data);

            return $res;

        }catch (Exception $e){

            DI()->logger->error('查看客户订单信息失败','客户id:'.$data->member_id.'异常信息:'.$e);

            return false;
        }

    }


    public function findAllProductOrder($data){

        try{

            $model=new Model_ProductOrder();

            $res=$model->findAllProductOrder($data);

            return $res;

        }catch (Exception $e){

            DI()->logger->error('通过会员id查看全部会员订单信息失败','客户id:'.$data->member_id.'异常信息:'.$e);

            return false;
        }

    }

    public function findProductOrderById($data){

        try{

            $model=new Model_ProductOrder();

            $res=$model->findProductOrderById($data->product_order_id);

            return $res;

        }catch (Exception $e){

            DI()->logger->error('通过id查看订单信息失败','订单id:'.$data->product_order_id.'异常信息:'.$e);

            return false;
        }
    }


    public function GetOrderBySession($data){

        try{

            $model=new Model_ProductOrder();

            $res=$model->GetOrderBySession($data->openid);

            return $res;

        }catch (Exception $e){

            DI()->logger->error('通过session查看订单信息失败','openid:'.$data->openid.'异常信息:'.$e);

            return false;
        }
    }

    public function deleteProductOrderById($data){

        try{

            $model=new Model_ProductOrder();

            $res=$model->deleteProductOrderById($data->product_order_id);

            return $res;

        }catch (Exception $e){

            DI()->logger->error('通过id删除订单信息失败','订单id:'.$data->product_order_id.'异常信息:'.$e);

            return false;
        }
    }

    public function confirmReceipt($data){

        try{

            $model=new Model_ProductOrder();

            $res=$model->confirmReceipt($data->product_order_id);

            return $res;

        }catch (Exception $e){

            DI()->logger->error('确认收货失败','订单id:'.$data->product_order_id.'异常信息:'.$e);

            return false;
        }
    }


}