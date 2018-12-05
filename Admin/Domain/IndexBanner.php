<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/5/15
 * Time: 11:46
 */
class Domain_IndexBanner{
//    获取所有banner
    public function Getlist(){
        $model=new Model_IndexBanner();
        $rel=$model->Getlist();
        return $rel;
    }
//新增banner
    public function UploadBanner($path){
        $model=new Model_IndexBanner();
        $rel=$model->UploadBanner($path);
        return $rel;
    }
    //删除
    public function DeleteBanner($id,$path){
        $model=new Model_IndexBanner();
        $rel=$model->DeleteBanner($id,$path);
        return $rel;
    }

    //修改
    public function ModifyBanner($id,$path){
        $model=new Model_IndexBanner();
        $rel=$model->ModifyBanner($id,$path);
        return $rel;
    }
}