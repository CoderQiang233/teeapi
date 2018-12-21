<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/5/15
 * Time: 11:47
 */
class Model_ProductBanner extends PhalApi_Model_NotORM{
    //获取所有banner
    public function Getlist(){
        $data=DI()->notorm->banner->select('*')->order('id DESC')->fetchAll();
        return $data;
    }

    //新增banner
    public function UploadBanner($path){
        $data=array(
            'path'=>$path,
            'create_time'=>date('Y-m-d H:i:s'),
        );

        $data=DI()->notorm->banner->insert($data);
        return $data;
    }
    //删除banner
    public function DeleteBanner($id,$path){
        $sc='C:/Users/Administrator/Desktop/dailiAP/Public/upload'.$path;
        @unlink($sc);
        $data=DI()->notorm->banner->where('id',$id)->delete();
        return $data;
    }
    //修改banner
    public function ModifyBanner($id,$path){
        $banner=DI()->notorm->banner->where('id',$id)->fetchOne();
        $sc='C:/Users/Administrator/Desktop/dailiAP/Public/upload'.$banner['path'];
        @unlink($sc);
        $data=array(
            'path'=>$path,
            'create_time'=>date('Y-m-d H:i:s'),
        );
        $data=DI()->notorm->banner->where('id',$id)->update($data);
        if ($data >= 1) {
            $rs=1;
        } else if ($data === 0) {
            $rs=1;
        } else if ($data === false) {
            $rs=0;
        }
        return $rs;
    }

}