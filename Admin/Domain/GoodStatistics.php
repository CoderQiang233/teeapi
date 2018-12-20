<?php
/**
 * Created by PhpStorm.
 * User: ${zhouyuan}
 * Date: 2018/11/6
 * Time: 11:05
 */

class Domain_GoodStatistics
{

    public function getList($data){

        try{

            $product = new Model_GoodStatistics();

            return $product ->getList($data);

        }catch (Exception $e){

            DI()->logger->error('商品销售统计失败','异常信息:'.$e);

            return false;
        }
    }


}