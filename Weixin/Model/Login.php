<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/12/12 0012
 * Time: 上午 11:11
 */
class Model_Login extends PhalApi_Model_NotORM
{

    public function index($openid){

        $order = DI()->notorm->members;

        $result = $order->where(array("openid" => $openid ))->fetchOne();

        return $result;

    }


    public  function userRegister($data){

        try{

            DI()->notorm->members->insert($data);

            return true;
        }catch (Exception $e){

            return false;

        }
    }



    public function insertInvoice($data){



        try{

            DI()->notorm->members->insert($data);

            return true;
        }catch (Exception $e){

            return false;

        }

    }
}