<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/5/16
 * Time: 17:41
 */
class Domain_UserManager{
    public function getUserList($data){
        $model=new Model_UserManager();

        return $model->getUserList($data);
    }


    public function addUser($data){
        $model=new Model_UserManager();

        return $model->addUser($data);
    }
    public function deleteUser($data){
        $model=new Model_UserManager();

        return $model->deleteUser($data);
    }
    public function editUser($data){
        $model=new Model_UserManager();

        return $model->editUser($data);
    }

    public function editPwd($data){
        $model=new Model_UserManager();

        return $model->editPwd($data);
    }
    public function adminEditPwd($data){
        $model=new Model_UserManager();

        return $model->adminEditPwd($data);
    }
}