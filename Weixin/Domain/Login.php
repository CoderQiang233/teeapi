<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/12/12 0012
 * Time: 上午 11:09
 */

class Domain_Login
{


    public function index($openid)
    {

        $model = new Model_Login();

        return $model->index($openid);


    }
}