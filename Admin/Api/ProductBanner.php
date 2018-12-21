<?php
/**
 * 产品系列轮播管理

 */

class Api_ProductBanner extends PhalApi_Api {

    public function getRules() {
        return array(
            'Getlist' => array(

            ),
            'UploadBanner' => array(
                'path' => array('name' => 'path', 'type' => 'string', 'require' => true, 'desc' => '图片路径'),
                ),
            'DeleteBanner' => array(
                'id' => array('name' => 'id', 'type' => 'string', 'require' => true, 'desc' => '数据ID'),
                'path' => array('name' => 'path', 'type' => 'string', 'require' => true, 'desc' => '文件路径'),
            ),
            'ModifyBanner' => array(
                'id' => array('name' => 'id', 'type' => 'string', 'require' => true, 'desc' => '数据ID'),
                'path' => array('name' => 'path', 'type' => 'string', 'require' => true, 'desc' => '文件路径'),
            ),


        );
    }

    /**
     * 获取banner列表
     */
    public function Getlist() {
        $domain=new Domain_ProductBanner();
        $data=$domain->Getlist();
        return $data;
    }

    /**
     * 上传banner图片
     */
    public function UploadBanner() {
        $rs = array('code' => 0, 'msg' => '', 'info' => array());
        $domain=new Domain_ProductBanner();
        $data=$domain->UploadBanner($this->path);
        if($data){
            $rs['code']=0;
            $rs['info']=$data;
        }else{
            $rs['code']=1;
            $rs['info']=$data;
        }
        return $rs;
    }

    /**
     * 删除banner图
     */
    public function DeleteBanner() {
        $rs = array('code' => 0, 'msg' => '', 'info' => array());
        $domain=new Domain_ProductBanner();
        $data=$domain->DeleteBanner($this->id,$this->path);
        if($data){
            $rs['code']=0;
            $rs['info']=$data;
        }else{
            $rs['code']=1;
            $rs['info']=$data;
        }
        return $rs;
    }

    /**
     * 修改banner图
     */
    public function ModifyBanner() {
        $rs = array('code' => 0, 'msg' => '', 'info' => array());
        $domain=new Domain_ProductBanner();
        $data=$domain->ModifyBanner($this->id,$this->path);
        if($data){
            $rs['code']=0;
            $rs['info']=$data;
        }else{
            $rs['code']=1;
            $rs['info']=$data;
        }
        return $rs;
    }



}
