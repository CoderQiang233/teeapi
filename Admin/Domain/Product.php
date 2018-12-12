<?php

/**
 * Created by PhpStorm.
 * User: lxl
 * Date: 2018/7/17
 * Time: 下午3:37
 */
class Domain_Product
{
    public function searchProduct($keyword){
        $product = new Model_Product();

        return $product ->searchProduct($keyword);
    }
    public function getlist($data){

        $product = new Model_Product();

        return $product ->getList($data);
    }

    public function insert($data){

        $product = new Model_Product();

        return $product ->insertProduct($data);
    }

    public function update($data){

        $product = new Model_Product();

        return $product ->updateProduct($data);
    }

    public function getById($id){

        $model = new Model_Product();

        return $model->getById($id);

    }

    public function deleteById($id){

        $model = new Model_Product();

        return $model->deleteById($id);

    }


    public function getMemberLevelList(){

        $product = new Model_Product();

        return $product ->getMemberLevelList();
    }



}