<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/10/11 0011
 * Time: 上午 9:52
 */

class Model_ProductShow extends PhalApi_Model_NotORM
{


    public function getProductList(){

        return DI()->notorm->commodity-> fetchAll();

    }



}