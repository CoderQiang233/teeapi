<?php
/**
 * 小程序首页布局管理
 *
 * @author: dogstar <chanzonghuang@gmail.com> 2014-10-04
 */

class Api_WeixinLayout  extends PhalApi_Api{
    public function getRules() {
        return array(
            'addModule'=> array(
                'name' => array('name' => 'name', 'type' => 'string',  'desc' => '模块名称'),
                'keyword'=> array('name' => 'keyword',  'type' => 'string', 'require' => true, 'desc' => '模块关键字'),
                'setting'=> array('name' => 'setting', 'type' => 'string', 'require' => true,  'desc' => '模块设置'),
                'sort_order'=> array('name' => 'sort_order', 'type' => 'string', 'require' => true,  'desc' => '模块排序'),

            ),
            'editModule'=> array(
                'name' => array('name' => 'name', 'type' => 'string',  'desc' => '模块名称'),
                'keyword'=> array('name' => 'keyword',  'type' => 'string', 'require' => true, 'desc' => '模块关键字'),
                'setting'=> array('name' => 'setting', 'type' => 'string', 'require' => true,  'desc' => '模块设置'),
                'sort_order'=> array('name' => 'sort_order', 'type' => 'string', 'require' => true,  'desc' => '模块排序'),
                'id'=> array('name' => 'id', 'type' => 'string', 'require' => true,  'desc' => '模块id'),

            ),
        );
    }


    /**
     * 获取首页模块
     * @desc  获取首页模块
     */
    public function getModuleList(){
        $rs = array('code' => 0, 'msg' => '', 'info' => array());
        $domain = new Domain_WeixinLayout();
        $rel=$domain->getModuleList();
        if ($rel) {
            $rs['code']=1;
            $rs['info']=$rel;
        }
        return $rs;
    }
    /**
     * 添加模块
     * @desc  添加模块
     */

    public function addModule(){
        $rs = array('code' => 0, 'msg' => '', 'info' => array());
        $domain = new Domain_WeixinLayout();
        $rel=$domain->addModule($this);
        if ($rel){
            $rs['code']=1;
        }
        return $rs;
    }
    /**
     * 修改模块
     * @desc  添加模块
     */

    public function editModule(){
        $rs = array('code' => 0, 'msg' => '', 'info' => array());
        $domain = new Domain_WeixinLayout();
        $rel=$domain->editModule($this);
        if ($rel){
            $rs['code']=1;
        }
        return $rs;
    }
    /**
     * 获取商品下拉框数据
     * @desc  添加模块
     */

    public function getProductOption(){
        $rs = array('code' => 0, 'msg' => '', 'info' => array());
        $domain = new Domain_WeixinLayout();
        $rel=$domain->getProductOption();
        if ($rel){
            $rs['code']=1;
            $rs['info']=$rel;
        }
        return $rs;
    }
}