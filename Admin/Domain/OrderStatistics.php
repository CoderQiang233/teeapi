<?php
/**
 * Created by PhpStorm.
 * User: ${zhouyuan}
 * Date: 2018/11/6
 * Time: 11:05
 */

class Domain_OrderStatistics
{

    public function getlist($data){

        $product = new Model_OrderStatistics();

        return $product ->getList($data);
    }


}