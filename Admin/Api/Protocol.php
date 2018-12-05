<?php
/**
 * 协议管理
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/5/17 0017
 * Time: 10:56
 */

class Api_Protocol extends PhalApi_Api {

    public function getRules() {
        return array(
            'addProtocol' => array(
                'token' => array('name' => 'token', 'type' => 'string', 'require' => true, 'desc' => '用户token'),
                'name' 	=> array('name' => 'name',  'type' => 'string', 'require' => true, 'desc' => '协议名称' ),
                'content' 	=> array('name' => 'content',  'type' => 'string', 'require' => true, 'desc' => '协议内容' ),
            ),
            'editProtocol' => array(
                'token' => array('name' => 'token', 'type' => 'string', 'require' => true, 'desc' => '用户token'),
                'name' 	=> array('name' => 'name',  'type' => 'string', 'require' => true, 'desc' => '协议名称' ),
                'content' 	=> array('name' => 'content',  'type' => 'string', 'require' => true, 'desc' => '协议内容' ),
                'id' 	=> array('name' => 'id',  'type' => 'string', 'require' => true, 'desc' => '协议ID' ),
            ),
            'delProtocol' => array(
                'token' => array('name' => 'token', 'type' => 'string', 'require' => true, 'desc' => '用户token'),
                'id' 	=> array('name' => 'id',  'type' => 'string', 'require' => true, 'desc' => '协议ID' ),
            ),
            'getListByCond' => array(
                'token' => array('name' => 'token', 'type' => 'string', 'require' => true, 'desc' => '用户token'),

            ),

        );
    }

    /**
     * 查询协议列表
     * @desc 用于查询协议列表
     * @return int code 操作码，1表示成功， 0表示失败
     * @return string msg 提示信息
     */
    public function getListByCond() {
        Common_GetReturn::checkToken($this->token);
        $domain=new Domain_Protocol();
        $data=$domain->getListByCond();
        return $data;
    }

    /**
     * 添加协议
     * @desc 添加协议
     * @return int code 操作码，1表示成功， 0表示失败
     * @return string msg 提示信息
     */
    public function addProtocol(){
        Common_GetReturn::checkToken($this->token);
        $rs = array('code' => 1, 'msg' => '', 'list' => []);
        $domain=new Domain_Protocol();
        $list=$domain->add($this);
        if (!$list['code']){
            $rs['code']=0;
            $rs['msg']=$list['msg'];
            return $rs;
        }
        $rs['list']=$list['data'];
        return $rs;
    }

    /**
     * 编辑协议
     * @desc 编辑协议
     * @return int code 操作码，1表示成功， 0表示失败
     * @return string msg 提示信息
     */

    public function editProtocol(){
//        Common_GetReturn::checkToken($this->token);
        $rs = array('code' => 1, 'msg' => '', 'list' => []);
        $domain=new Domain_Protocol();
        $list=$domain->edit($this);
        if (!$list['code']){
            $rs['code']=0;
            $rs['msg']=$list['msg'];
            return $rs;
        }
        $rs['list']=$list['data'];
        return $rs;
    }



    /**
     * 删除协议
     * @desc 删除协议
     * @return int code 操作码，1表示成功， 0表示失败
     * @return string msg 提示信息
     */
    public function delProtocol(){
        Common_GetReturn::checkToken($this->token);
        $rs = array('code' => 1, 'msg' => '', 'list' => []);
        $domain=new Domain_Protocol();
        $rel=$domain->del($this->id);
        if(!$rel['code']){
            $rs['code']=0;
            $rs['msg']=$rel['msg'];
            return $rs;
        }
        $rs['list']=$rel['data'];
        return $rs;
    }



}