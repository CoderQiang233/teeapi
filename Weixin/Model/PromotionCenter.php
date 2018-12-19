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


}