<?php
/**
 * 小程序首页接口

 */
class Api_IndexPage extends PhalApi_Api {
    public function getRules() {

    }


    /**
     * 获取banner列表
     */
    public function getBanner(){
        $rs = array('code' => 0, 'msg' => '', 'list' => array());
        $domain=new Domain_IndexPage();
        $rel=$domain->getBanner();
        $rs['list']=$rel;
        return $rs;
    }
    /**
     * 获取首页模块
     */
    public function getModules(){
        $rs = array('code' => 0, 'msg' => '', 'list' => array());
        $domain=new Domain_IndexPage();
        $rel=$domain->getModules();
        $rs['list']=$rel;
        return $rs;
    }
}