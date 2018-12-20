<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/12/20
 * Time: 13:59
 */
class Model_Member extends PhalApi_Model_NotORM{
    public function getMemberBalance($openid){
        $member= DI()->notorm->members->where('openid',$openid)->fetchOne();
        return $member;
    }

    public function joinPromotion($openid){
        $rel=DI()->notorm->members->where('openid',$openid)->update(array('is_promoter'=>1));
        return $rel;
    }
}