<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/12/11
 * Time: 15:04
 */
class Domain_WeixinLayout
{
    public function getModuleList(){
        $model=new Model_WeixinLayout();
        $rel=$model->getModuleList();
        return $rel;
    }
    public function addModule($data){
        $model=new Model_WeixinLayout();
        $rel=$model->addModule($data);
        return $rel;
    }
    public function editModule($data){
        $model=new Model_WeixinLayout();
        $rel=$model->editModule($data);
        return $rel;
    }
    public function getProductOption(){
        $model=new Model_WeixinLayout();
        $rel=$model->getProductOption();
        return $rel;
    }
}