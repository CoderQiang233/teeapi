<?php

/**
 * Created by PhpStorm.
 * User: lxl
 * Date: 2018/7/20
 * Time: 上午11:02
 */
class Model_Notice extends PhalApi_Model_NotORM
{

    public function getHomeNotice(){


      return  DI()->notorm->notice->where(array("is_use" => 1,"type"=>"notice"))->fetchOne();

    }


}