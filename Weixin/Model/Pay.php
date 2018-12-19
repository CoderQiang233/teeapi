<?php

/**
 * 支付订单
 * User: lxl
 * Date: 2018/7/18
 * Time: 下午5:42
 */
class Model_Pay extends PhalApi_Model_NotORM{





    public function addOrder($data,$products){

        try{
            $openid=$data['openid'];
            $members=DI()->notorm->members->where('openid',$openid)->fetchOne();
            $member_id=$members['id'];
            $data['member_id']=$member_id;
            $province=DI()->notorm->province->where('name',$data['province_name'])->fetchOne();
            $data['province_code']=$province['map_code'];
            $rel=DI()->notorm->order->insert($data);
            $productArr=array();
//            foreach ($products as $item){
//                $data=DI()->notorm->product->select('product_id','name','first_picture','market_price','intro')->where('product_id',$item['id'])->fetchOne();
//            }
            $products['order_id']=$rel['id'];
            $rel=DI()->notorm->order_product->insert($products);
            return $rel['id'];





        }catch (Exception $e){

            DI() -> logger -> error('生成订单失败原因: ',$e);
            return false;

        }

    }





}