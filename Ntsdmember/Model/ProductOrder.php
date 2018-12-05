<?php

/**
 * Created by PhpStorm.
 * User: lxl
 * Date: 2018/7/17
 * Time: 下午3:38
 */
class Model_ProductOrder extends PhalApi_Model_NotORM
{
    public function orderPay($data){

        try{
            //购买数量
            $num=$data->commodityNum;

            $product=DI()->notorm->commodity->where('id',$data->product_id)->fetchOne();

            //获取原有数量
            $before=$product['num'];

            if($num>$before) {

                DI()->logger->info($product['name'].'库存不足');

                return 'warn';
            }

            $info=array(
                'commodity_name' => $data->commodityName,
                'commodity_price' => $data->commodityPrice,
                'commodity_num' => $data->commodityNum,
                'members_id' => $data->membersId,
                'pay' => '0',
                'create_time' => date("Y-m-d H:i:s"),
                'openid' => $data->openId,
                'order_id' => $data->id,
                'shipping_address' => $data->shippingAddress,
                'province_code' => $data->province_code,
                'province_name' => $data->province_name,
                'ship_status' => '0',//0:未发货，1：已发货
                'product_id' => $data->product_id,
            );
            DI()->notorm->commodity_order->insert($info);

            return 'success';

        }catch (Exception $e){

            DI()->logger->log('insertorder','插入订单表',$e);

            return false;
        }

    }
    public function getProductOrderById($id){

        return DI()->notorm->commodity_order->where('members_id',$id)->fetchAll();

    }
}