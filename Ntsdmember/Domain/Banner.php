<?php

/**
 * Created by PhpStorm.
 * User: lxl
 * Date: 2018/7/20
 * Time: 上午10:42
 */
class Domain_Banner
{
    public function getbanners(){

        $model = new Model_Banner();

        return $model->getbanner();

    }
}