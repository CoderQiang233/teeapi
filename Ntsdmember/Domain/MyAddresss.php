<?php



/**
 * Created by PhpStorm.
 * User: zy
 * Date: 2018/7/20
 * Time: 下午4:48
 */
class Domain_MyAddresss
{

    public function getMyAddresssById($id){


        $model = new Model_MyAddresss();

        return $model -> getMyAddresssById($id);

    }

    public function insertMyAddresss($data){

        $model = new Model_MyAddresss();

        return $model -> insertMyAddresss($data);

    }


    public function updateMyAddresss($data){

        $model = new Model_MyAddresss();

        return $model -> updateMyAddresss($data);

    }

    public function getMyAddresssBySession3rd($openid){

        $model = new Model_MyAddresss();

        return $model ->getMyAddresssBySession3rd($openid);


    }

    public function inAddress($openid){

        $model = new Model_MyAddresss();

        return $model ->inAddress($openid);


    }

}