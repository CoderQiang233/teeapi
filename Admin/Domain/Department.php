<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/5/16
 * Time: 17:41
 */
class Domain_Department{
    public function getDepartmentList($data){
        $model=new Model_Department();

        return $model->getDepartmentList($data);
    }
    public function getDepartments(){
        $model=new Model_Department();

        return $model->getDepartments();
    }

    public function addDepartment($data){
        $model=new Model_Department();

        return $model->addDepartment($data);
    }
    public function deleteDepartment($data){
        $model=new Model_Department();

        return $model->deleteDepartment($data);
    }
    public function editDepartment($data){
        $model=new Model_Department();

        return $model->editDepartment($data);
    }
}