<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/12/12 0012
 * Time: 上午 11:09
 */

class Domain_PromotionCenter
{


    public function getInfo($data)
    {

        $model = new Model_PromotionCenter();

        return $model->getInfo($data->openid);


    }


}