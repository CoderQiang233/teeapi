<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/5/10
 * Time: 14:12
 */
require_once dirname(__FILE__) .'./JWT/helpers/jwt_helper.php';

class Common_GetReturn{

//    Model 返回数据格式化

    static public function getReturn($code,$msg,$data){
        $arry=array(
            'code'=>$code,
            'msg'=>$msg,
            'data'=>$data
        );
        return $arry;
    }

    /**
     * 获取token
     * @desc 用于获取单个用户基本信息
     * @return int code 操作码，1表示成功， 0表示失败
     * @return string msg 提示信息
     */

    static public function getToken($user){

        $userStr = json_encode($user);
        $token=jwt_helper::create($userStr);

        return $token;
    }
    /**
     * 解析token
     * @desc 用于获取单个用户基本信息
     * @return int code 操作码，1表示成功， 0表示失败
     * @return string msg 提示信息
     */
    static public function checkToken($token){
        $rs =null;
        $token=jwt_helper::decode($token);
        if (!$token){
            throw new PhalApi_Exception_BadRequest(T('会话失效，请重新登录'), 1);
        }else{
             $rs= json_decode($token->user);
        }
        return $rs;
    }


///**
//* 根据token获取openid session_key
//*/
//    static public function getOpenidByToken($token){
//        $domain=new Domain_Login();
//        $rel=$domain->getOpenidByToken($token);
//        return $rel;
//    }
///**
//* 根据token获取phoneNum
//*/
//    static public function getPhoneNumByToken($token){
//        $domain=new Domain_Login();
//        $rel=$domain->getPhoneNumByToken($token);
//        return $rel;
//    }
}