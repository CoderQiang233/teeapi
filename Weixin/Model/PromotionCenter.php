<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/12/12 0012
 * Time: 上午 11:11
 */
class Model_PromotionCenter extends PhalApi_Model_NotORM
{

    public function getInfo($openid){

        $member=DI()->notorm->members->where('openid',$openid)->fetchOne();

        $commission_history=DI()->notorm->commission_history->where(array('member_id'=>$member['id'],'status'=>1,'type'=>0))->fetchAll();

        $PromotionMoney=0;

        if($commission_history){
            foreach ($commission_history as $item){
                $PromotionMoney+=$item['total'];
            }
        }

        $consumption=DI()->notorm->commission_history->where(array('member_id'=>$member['id'],'status'=>1,'type'=>1))->fetchAll();

        $consumptionMoney=0;

        if($consumption){
            foreach ($consumption as $item){
                $consumptionMoney+=$item['total'];
            }
        }

        $member['PromotionMoney']=$PromotionMoney;


        $member['consumptionMoney']=$consumptionMoney;

        return $member;
    }


    public function getOrder($openid){

        $member=DI()->notorm->members->where('openid',$openid)->fetchOne();

        $id=$member['id'];

        $order_product=DI()->notorm->order_product->where('promoter',$id)->fetchAll();

        $orderArray=array();
        foreach ($order_product as $o){
            $order=DI()->notorm->order->where(array('order_id'=>$o['order_id'],'pay is not 0'))->fetchOne();
            $o['order']=$order;
            $history=DI()->notorm->commission_history->where('order_product_id',$o['order_product_id'])->fetchOne();
            $o['history']=$history;
            $Purchaser=DI()->notorm->members->select('nick_name')->where('id',$order['member_id'])->fetchOne();
            $o['Purchaser_name']=$Purchaser['nick_name'];
            array_push($orderArray,$o);
        }


        return $orderArray;
    }



}