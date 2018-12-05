<?php

/**
 * Created by PhpStorm.
 * User: lxl
 * Date: 2018/7/17
 * Time: 下午3:37
 */
class Domain_Member
{

    public function getlist(){


        $member = new Model_Member();

        return $member ->getList();


    }

    public function getById($id){

        $model = new Model_Member();

        return $model->getById($id);

    }


    public function checkPhone($phone){

        $model = new Model_Member();

        return $model->checkPhone($phone);

    }

    public function checkIdcard($idcard){

        $model = new Model_Member();

        return $model->checkIdcard($idcard);

    }


    public function checkRefereePhone($phone){

        $model = new Model_Member();

        return $model->checkRefereePhone($phone);

    }
    public function getrefereeByPhone($phone){


        $model = new Model_Member();

        return $model -> getrefereeByPhone($phone);

    }



}