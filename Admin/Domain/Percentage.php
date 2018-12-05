<?php
/**
 * Created by PhpStorm.
 * User: ${zhouyuan}
 * Date: 2018/11/9
 * Time: 14:44
 */
class Domain_Percentage
{

    public function getlist($data){

        $product = new Model_Percentage();

        return $product ->getList($data);
    }
    public function insert($data){

        $product = new Model_Percentage();

        return $product ->insertPercentage($data);
    }
    public function update($data){

        $product = new Model_Percentage();

        return $product ->updatePercentage($data);
    }
    public function deleteById($data){

        $product = new Model_Percentage();

        return $product ->deleteById($data);
    }

}