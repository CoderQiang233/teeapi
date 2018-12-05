<?php

/**
 * Created by PhpStorm.
 * User: lxl
 * Date: 2018/7/17
 * Time: 下午3:37
 */
class Domain_Product
{

    public function getlist(){


        $member = new Model_Product();

        return $member ->getList();


    }

    public function getById($id){

        $model = new Model_Product();

        return $model->getById($id);

    }

    public function getByOpenId($openId){

        $model = new Model_Product();

        return $model->getByOpenId($openId);

    }

    public function getMemberOrder($id){

        $model = new Model_Product();

        return $model->getMemberOrder($id);

    }

}