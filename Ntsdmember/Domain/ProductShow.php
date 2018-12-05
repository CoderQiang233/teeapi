<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/10/11 0011
 * Time: 上午 9:52
 */

class Domain_ProductShow{

    public  function getProductLists(){

        $model = new Model_ProductShow();

        return $model->getProductList();

    }
}