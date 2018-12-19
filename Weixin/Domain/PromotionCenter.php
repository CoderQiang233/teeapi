<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/12/12 0012
 * Time: 上午 11:09
 */

class Domain_PromotionCenter
{


    public function getProudct($id)
    {

        $model = new Model_Product();

        return $model->getProudct($id);


    }


}