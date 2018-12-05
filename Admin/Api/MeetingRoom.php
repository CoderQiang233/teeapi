<?php
/**
 * 会议室管理
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/5/17 0017
 * Time: 15:20
 */

class Api_MeetingRoom extends PhalApi_Api {

    public function getRules() {
        return array(
            'addMeetingRoom' => array(
                'token' => array('name' => 'token', 'type' => 'string', 'require' => true, 'desc' => '用户token'),
                'roomName' 	=> array('name' => 'roomName',  'type' => 'string', 'require' => true, 'desc' => '会议室名称' ),
                'numbers' 	=> array('name' => 'numbers',  'type' => 'string', 'require' => true, 'desc' => '容纳人数' ),
            ),
            'editMeetingRoom' => array(
                'token' => array('name' => 'token', 'type' => 'string', 'require' => true, 'desc' => '用户token'),
                'roomName' 	=> array('name' => 'roomName',  'type' => 'string', 'require' => true, 'desc' => '会议室名称' ),
                'numbers' 	=> array('name' => 'numbers',  'type' => 'string', 'require' => true, 'desc' => '容纳人数' ),
                'id' 	=> array('name' => 'id',  'type' => 'string', 'require' => true, 'desc' => '会议室ID' ),
            ),
            'delMeetingRoom' => array(
                'token' => array('name' => 'token', 'type' => 'string', 'require' => true, 'desc' => '用户token'),
                'id' 	=> array('name' => 'id',  'type' => 'string', 'require' => true, 'desc' => '会议室ID' ),
            ),
            'getList' => array(
                'token' => array('name' => 'token', 'type' => 'string', 'require' => true, 'desc' => '用户token'),
            ),

        );
    }

    /**
     * 查询会议室列表
     * @desc 用于查询会议室列表
     * @return int code 操作码，1表示成功， 0表示失败
     * @return string msg 提示信息
     */
    public function getList() {
        Common_GetReturn::checkToken($this->token);
        $domain=new Domain_MeetingRoom();
        $data=$domain->getList();
        return $data;
    }

    /**
     * 添加会议室
     * @desc 添加会议室
     * @return int code 操作码，1表示成功， 0表示失败
     * @return string msg 提示信息
     */
    public function addMeetingRoom(){
//        Common_GetReturn::checkToken($this->token);
        $rs = array('code' => 1, 'msg' => '', 'list' => []);
        $domain=new Domain_MeetingRoom();
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
     * 编辑会议室
     * @desc 编辑会议室
     * @return int code 操作码，1表示成功， 0表示失败
     * @return string msg 提示信息
     */

    public function editMeetingRoom(){
        Common_GetReturn::checkToken($this->token);
        $rs = array('code' => 1, 'msg' => '', 'list' => []);
        $domain=new Domain_MeetingRoom();
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
     * 删除会议室
     * @desc 删除会议室
     * @return int code 操作码，1表示成功， 0表示失败
     * @return string msg 提示信息
     */
    public function delMeetingRoom(){
        Common_GetReturn::checkToken($this->token);
        $rs = array('code' => 1, 'msg' => '', 'list' => [],'departments'=>[]);
        $domain=new Domain_MeetingRoom();
        $rel=$domain->del($this->id);

        $rs['list']=$rel['data'];
        if(!$rel['code']){
            $rs['code']=0;
            $rs['msg']=$rel['msg'];
            return $rs;
        }
        return $rs;
    }


    public function getmeetingroomlist() {
        $domain=new Domain_MeetingRoom();
        $data=$domain->getMeetingRoomList();
        $rs['data']=$data;

        return $rs;
    }



}