<?php
/**
 * Created by PhpStorm.
 * User: ${zhouyuan}
 * Date: 2018/11/6
 * Time: 11:05
 */

class Domain_GoodStatistics
{

    public function getlist($data){

        $product = new Model_GoodStatistics();

        return $product ->getList($data);
    }


}