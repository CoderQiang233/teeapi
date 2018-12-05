<?php
/**
 * Created by PhpStorm.
 * User: ${zhouyuan}
 * Date: 2018/10/19
 * Time: 15:39
 */
class Domain_CompanyProfile
{

    public function getlist($data){

        $product = new Model_CompanyProfile();

        return $product ->getList($data);
    }

    public function insert($data){

        $product = new Model_CompanyProfile();

        return $product ->insertNews($data);
    }

    public function update($data){

        $product = new Model_CompanyProfile();

        return $product ->updateNews($data);
    }


    public function deleteById($id){

        $model = new Model_CompanyProfile();

        return $model->deleteById($id);

    }
    public function change($data){

        $product = new Model_CompanyProfile();

        return $product ->change($data);
    }
}