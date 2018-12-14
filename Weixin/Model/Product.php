<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/12/12 0012
 * Time: 上午 11:11
 */
class Model_Product extends PhalApi_Model_NotORM
{

    public function getProudct($id){

        $result = DI()->notorm->product->where(array("product_id" => $id ))->fetchOne();

        $banner=DI()->notorm->product_banner->where(array("product_id" => $id ))->fetchAll();

        $result['banner_list']=$banner;
        return $result;
    }


}