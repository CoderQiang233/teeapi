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
            $orderNum=DI()->notorm->commodity_order->where(array('pay'=>'1','commodity_num > ? '=> 0))->count('id');
            //总价格
            $totalPrice=DI()->notorm->commodity_order->where(array('pay'=>'1','commodity_num > ? '=> 0))->sum('commodity_num*commodity_price');
            //总客户数
            $userNum=DI()->notorm->members->where('flag', 1)->count('id');

            return array(
                'orderNum' => $orderNum,
//                'totalPrice' => $totalPrice>10000?($totalPrice/1000).'K':$totalPrice,
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
            $provinceData=DI()->notorm->commodity_order
                ->select('province_code, province_name, count(*) as total,SUM(commodity_num*commodity_price) as amount')
                ->where(array('pay'=>'1','commodity_num > ? '=> 0))->group('province_code')->fetchAll();

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

            $sqls = 'SELECT o.*,m.name,m.phone,o.id as `key` '
                . 'FROM commodity_order AS o LEFT JOIN members AS m '
                . 'ON o.members_id=m.id WHERE o.pay=1 and o.commodity_num>0 '
                .' order by o.id desc  limit 6 ';

            $result= DI()->notorm->commodity_order->queryAll($sqls);

            return $result;

        }catch (Exception $e){

            DI()->logger->log('index','获取最新6条订单','$e');

            return false;
        }
    }





}