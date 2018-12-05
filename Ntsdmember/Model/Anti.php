<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/9/29 0029
 * Time: 下午 4:19
 */
class Model_Anti extends PhalApi_Model_NotORM
{


    public function getAntiId($securitycode){

        return DI()->notorm->security_code->where('securitycode',$securitycode) -> fetchOne();

    }


    public function getImg(){

        return DI()->notorm->product_banner->where('is_use',1) ->fetchAll();

    }

    public function getPic(){

        return DI()->notorm->product_banner ->where('is_use',2) ->fetchAll();

    }
}