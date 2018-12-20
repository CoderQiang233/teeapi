<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/12/20
 * Time: 13:59
 */
class Domain_Member
{
    public function getMemberBalance($openid){
        $model = new Model_Member();
        return $model->getMemberBalance($openid);
    }

    public function joinPromotion($openid){
        $model = new Model_Member();
        return $model->joinPromotion($openid);
    }
}