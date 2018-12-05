<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/5/15
 * Time: 11:46
 */
class Domain_Login{
    public function Login($username,$password){
        $model=new Model_Login();
        $rel=$model->Login($username,$password);
        return $rel;
    }
}