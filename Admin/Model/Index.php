<?php

/**
 * Created by PhpStorm.
 * User: lxl
 * Date: 2018/7/17
 * Time: 下午3:38
 */
class Model_Index extends PhalApi_Model_NotORM
{


    //获取订单总数
    public function getProductOrderCount(){

        try{
            //订单总数
            $orderNum=DI()->notorm->order->where(array('pay > ?'=>Common_OrderStatus::ORDER_STATUS_0,'status'=> 0))->count('order_id');
            //总价格
            $totalPrice=DI()->notorm->order->where(array('pay > ?'=>Common_OrderStatus::ORDER_STATUS_0,'status'=> 0))->sum('total');
            //总客户数
            $userNum=DI()->notorm->members->count('id');

            return array(
                'orderNum' => $orderNum,
                'totalPrice' => $totalPrice==null?0:$totalPrice,
                'userNum' => $userNum,
            );

        }catch (Exception $e){

            DI()->logger->log('index','获取首页统计数据失败','$e');

            return false;

        }

    }

    //获取各省订单总数
    public function getProductOrderProvince(){

        try{

            $json = array();

            //各省订单总数
            $provinceData=DI()->notorm->order
                ->select('province_code, province_name, count(*) as total,SUM(total) as amount')
                ->where(array('pay > ?'=>Common_OrderStatus::ORDER_STATUS_0,'status'=> 0))->group('province_code')->fetchAll();

            foreach ($provinceData as $result) {
                $json[strtoupper($result['province_code'])] = array(
                    'total'  => $result['total'],
                    'amount' => $result['amount']
                );
            }

            return $json;

        }catch (Exception $e){

            DI()->logger->log('index','获取各省统计数据失败','$e');

            return false;

        }

    }

    /**
     * 获取最新6条订单
     */
    public function getProductOrderNewest(){
        try{

            $sqls = 'SELECT o.*,m.nick_name,m.phone,o.order_id as `key` '
                . 'FROM shop_order AS o LEFT JOIN shop_members AS m '
                . 'ON o.member_id=m.id WHERE o.pay=:pay and o.status=0 '
                .' order by o.order_id desc  limit 6 ';

            $params=array(':pay'=>Common_OrderStatus::ORDER_STATUS_1);

            $result= DI()->notorm->order->queryAll($sqls,$params);

            return $result;

        }catch (Exception $e){

            DI()->logger->log('index','获取最新6条订单','$e');

            return false;
        }
    }





}