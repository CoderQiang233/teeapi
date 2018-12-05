<?php
/**
 * Created by PhpStorm.
 * User: ${zhouyuan}
 * Date: 2018/10/17
 * Time: 14:51
 */
class Domain_News
{

    public function getlist($data){

        $product = new Model_News();

        return $product ->getList($data);
    }

    public function insert($data){

        $product = new Model_News();

        return $product ->insertNews($data);
    }

    public function update($data){

        $product = new Model_News();

        return $product ->updateNews($data);
    }


    public function deleteById($id){

        $model = new Model_News();

        return $model->deleteById($id);

    }
    public function change($data){

        $product = new Model_News();

        return $product ->change($data);
    }
}