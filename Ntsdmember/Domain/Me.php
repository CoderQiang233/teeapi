<?php

/**
 * Created by PhpStorm.
 * User: lxl
 * Date: 2018/7/19
 * Time: 下午5:12
 */
class Domain_Me{


    public function index($openid){

        $model = new Model_Me();

        return $model ->index($openid);


    }

    public function getkucun($openid){

        $model = new Model_Me();

        return $model ->getkucun($openid);


    }

    public function getfanxian($openid,$curentmonth){

        $model = new Model_Me();

        return $model ->getfanxian($openid,$curentmonth);


    }

    public function GetQualification($openid){

        $model = new Model_Me();

        return $model ->GetQualification($openid);


    }


}