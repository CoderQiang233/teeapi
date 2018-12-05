<?php
/**
 * Created by PhpStorm.
 * User: Administrator
<<<<<<< HEAD
 * Date: 2018/5/16
 * Time: 17:41
 */
class Domain_Staff{
    public function getStaffList($data){
        $model=new Model_Staff();

        return $model->getStaffList($data);
    }


    public function addStaff($data){
        $model=new Model_Staff();

        return $model->addStaff($data);
    }
    public function deleteStaff($data){
        $model=new Model_Staff();

        return $model->deleteStaff($data);
    }
    public function editStaff($data)
    {
        $model = new Model_Staff();

        return $model->editStaff($data);
    }
    public function getStaffTree(){
        $model=new Model_Staff();
        $rel=$model->getStaffTree();
        return $rel;
    }

    public function importStaff($data){
        $model=new Model_Staff();
        $rel=$model->importStaff($data);
        return $rel;
    }
}