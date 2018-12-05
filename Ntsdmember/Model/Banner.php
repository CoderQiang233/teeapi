<?php

/**
 * Created by PhpStorm.
 * User: lxl
 * Date: 2018/7/20
 * Time: 上午10:43
 */
class Model_Banner extends PhalApi_Model_NotORM
{

    public function getbanner(){




      $result =  DI()->notorm->banner->where("is_use",1)->fetchAll();


        return $result;

    }

}