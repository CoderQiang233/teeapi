<?php

/**
 * Created by PhpStorm.
 * User: lxl
 * Date: 2018/7/20
 * Time: 上午11:01
 */
class Domain_Notice
{

    public function  getHomeNotice(){

        $model = new Model_Notice();

        return $model -> getHomeNotice();


    }

}