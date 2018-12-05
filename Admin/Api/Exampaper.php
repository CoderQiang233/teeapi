<?php
/**
 * 试题管理
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/5/24 0024
 * Time: 18:24
 */

class Api_Exampaper extends PhalApi_Api {

    public function getRules() {
        return array(
            'addExampaper' => array(
                'token' => array('name' => 'token', 'type' => 'string', 'require' => true, 'desc' => '用户token'),
                'title' 	=> array('name' => 'title',  'type' => 'string', 'require' => true, 'desc' => '题目' ),
                'score' 	=> array('name' => 'score',  'type' => 'string', 'require' => true, 'desc' => '分数' ),
                'answer' 	=> array('name' => 'answer',  'type' => 'string', 'require' => true, 'desc' => '答案' ),
                'options' 	=> array('name' => 'options',  'type' => 'string', 'require' => true, 'desc' => '选项内容' ),
                'meetingId' => array('name' => 'meetingId',  'type' => 'string', 'require' => true, 'desc' => '会议ID' ),
                'type' 	=> array('name' => 'type',  'type' => 'string', 'require' => true, 'desc' => '试题类型' ),
            ),
            'editExampaper' => array(
                'token' => array('name' => 'token', 'type' => 'string', 'require' => true, 'desc' => '用户token'),
                'title' 	=> array('name' => 'title',  'type' => 'string', 'require' => true, 'desc' => '题目' ),
                'score' 	=> array('name' => 'score',  'type' => 'string', 'require' => true, 'desc' => '分数' ),
                'answer' 	=> array('name' => 'answer',  'type' => 'string', 'require' => true, 'desc' => '答案' ),
                'options' 	=> array('name' => 'options',  'type' => 'string', 'require' => true, 'desc' => '选项内容' ),
                'meetingId' 	=> array('name' => 'meetingId',  'type' => 'string', 'require' => true, 'desc' => '会议ID' ),
                'id' 	=> array('name' => 'id',  'type' => 'string', 'require' => true, 'desc' => '试题ID' ),
            ),
            'delExampaper' => array(
                'token' => array('name' => 'token', 'type' => 'string', 'require' => true, 'desc' => '用户token'),
                'id' 	=> array('name' => 'id',  'type' => 'string', 'require' => true, 'desc' => '试题ID' ),
                'meetingId' 	=> array('name' => 'meetingId',  'type' => 'string', 'require' => true, 'desc' => '会议ID' ),
            ),
            'getList' => array(
                'token' => array('name' => 'token', 'type' => 'string', 'require' => true, 'desc' => '用户token'),
                'meetingId' => array('name' => 'meetingId', 'type' => 'string', 'require' => true, 'desc' => '会议ID'),
            ),

        );
    }

    /**
     * 查询试题列表
     * @desc 用于查询试题室列表
     * @return int code 操作码，1表示成功， 0表示失败
     * @return string msg 提示信息
     */
    public function getList() {
        Common_GetReturn::checkToken($this->token);
        $domain=new Domain_Exampaper();
        $data=$domain->getList($this->meetingId);
        return $data;
    }

    /**
     * 添加试题
     * @desc 添加试题
     * @return int code 操作码，1表示成功， 0表示失败
     * @return string msg 提示信息
     */
    public function addExampaper(){
        Common_GetReturn::checkToken($this->token);
        $rs = array('code' => 1, 'msg' => '', 'list' => []);
        $domain=new Domain_Exampaper();
        $list=$domain->add($this);
        $rs['list']=$list['data'];
        if (!$list['code']){
            $rs['code']=0;
            $rs['msg']=$list['msg'];
            return $rs;
        }
        return $rs;
    }

    /**
     * 编辑试题
     * @desc 编辑试题
     * @return int code 操作码，1表示成功， 0表示失败
     * @return string msg 提示信息
     */

    public function editExampaper(){
        Common_GetReturn::checkToken($this->token);
        $rs = array('code' => 1, 'msg' => '', 'list' => []);
        $domain=new Domain_Exampaper();
        $list=$domain->edit($this);
        $rs['list']=$list['data'];
        if (!$list['code']){
            $rs['code']=0;
            $rs['msg']=$list['msg'];
            return $rs;
        }
        return $rs;
    }



    /**
     * 删除试题
     * @desc 删除试题
     * @return int code 操作码，1表示成功， 0表示失败
     * @return string msg 提示信息
     */
    public function delExampaper(){
        Common_GetReturn::checkToken($this->token);
        $rs = array('code' => 1, 'msg' => '', 'list' => []);
        $domain=new Domain_Exampaper();
        $rel=$domain->del($this->id,$this->meetingId);

        $rs['list']=$rel['data'];
        if(!$rel['code']){
            $rs['code']=0;
            $rs['msg']=$rel['msg'];
            return $rs;
        }
        return $rs;
    }





}