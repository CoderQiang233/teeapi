<?php

/**
 * Created by PhpStorm.
 * User: lxl
 * Date: 2018/7/17
 * Time: 下午3:37
 */
class Domain_Inventory
{

    public function editTotalInventory($data){

        $product = new Model_Inventory();

        return $product ->editTotalInventory($data);
    }

    public function getInventoryRecordTotal($data){

        $product = new Model_Inventory();

        return $product ->getInventoryRecordTotal($data);
    }

    public function getInventoryAgent($data){

        $product = new Model_Inventory();

        return $product ->getInventoryAgent($data);
    }

    public function getAgentProductRecord($data){

        $model = new Model_Inventory();

        return $model->getAgentProductRecord($data);

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