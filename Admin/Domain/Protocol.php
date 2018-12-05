<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/5/17 0017
 * Time: 11:07
 */
class Domain_Protocol{
    public function getListByCond(){
        $model=new Model_Protocol();
        $rel=$model->getListByCond();
        return $rel;
    }

    public function add($data){
        $model=new Model_Protocol();
        $rel=$model->add($data);
        return $rel;
    }
    public function edit($data){
        $model=new Model_Protocol();
        $rel=$model->edit($data);
        return $rel;
    }
    public function del($data){
        $model=new Model_Protocol();
        $rel=$model->del($data);
        return $rel;
    }
}