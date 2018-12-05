<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/5/15
 * Time: 11:46
 */
class Domain_ProductBanner{
//    获取所有banner
    public function Getlist(){
        $model=new Model_ProductBanner();
        $rel=$model->Getlist();
        return $rel;
    }
//新增banner
    public function UploadBanner($path,$is_use){
        $model=new Model_ProductBanner();
        $rel=$model->UploadBanner($path,$is_use);
        return $rel;
    }
    //删除
    public function DeleteBanner($id,$path){
        $model=new Model_ProductBanner();
        $rel=$model->DeleteBanner($id,$path);
        return $rel;
    }

    //修改
    public function ModifyBanner($id,$path,$is_use){
        $model=new Model_ProductBanner();
        $rel=$model->ModifyBanner($id,$path,$is_use);
        return $rel;
    }
}