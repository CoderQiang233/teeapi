<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/5/15
 * Time: 11:47
 */
class Model_Login extends PhalApi_Model_NotORM{
    public function Login($username,$password){
        $data=DI()->notorm->user->select('*')->where('username',$username)->where('pwd', hash("sha256", $password))->fetchOne();
        return $data;
    }
}