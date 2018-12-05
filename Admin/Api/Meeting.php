<?php
/**
 * 会议管理
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/5/17 0017
 * Time: 10:56
 */

class Api_Meeting extends PhalApi_Api {

    public function getRules() {
        return array(
            'addMeeting' => array(
                'token' => array('name' => 'token', 'type' => 'string', 'require' => true, 'desc' => '用户token'),
                'meetingName' 	=> array('name' => 'meetingName',  'type' => 'string', 'require' => true, 'desc' => '会议主题' ),
                'lecturer' 	=> array('name' => 'lecturer',  'type' => 'string', 'require' => true, 'desc' => '讲师' ),
                'introduction' 	=> array('name' => 'introduction',  'type' => 'string', 'require' => true, 'desc' => '讲师简介' ),
                'time' 	=> array('name' => 'time',  'type' => 'string', 'require' => true, 'desc' => '时间' ),
                'meetingRoom' 	=> array('name' => 'meetingRoom',  'type' => 'string', 'require' => true, 'desc' => '地点' ),
                'inchargeDept' 	=> array('name' => 'inchargeDept',  'type' => 'string', 'require' => true, 'desc' => '主办部门' ),
                'organizer' 	=> array('name' => 'organizer',  'type' => 'string', 'require' => true, 'desc' => '组织者' ),
                'content' 	=> array('name' => 'content',  'type' => 'string', 'require' => true, 'desc' => '会议内容' ),
                'members' 	=> array('name' => 'members',  'type' => 'string', 'require' => true, 'desc' => '参会人员' ),
                'protocol' 	=> array('name' => 'protocol',  'type' => 'string', 'require' => true, 'desc' => '培训协议' ),
                'test' 	=> array('name' => 'test',  'type' => 'string', 'require' => true, 'desc' => '随堂考试' ),
                'beginTime' 	=> array('name' => 'beginTime',  'type' => 'string', 'require' => true, 'desc' => '会议开始日期' ),
                'endTime' 	=> array('name' => 'endTime',  'type' => 'string', 'require' => true, 'desc' => '会议结束日期' ),
                'hasPhoto' 	=> array('name' => 'hasPhoto',  'type' => 'string', 'require' => true, 'desc' => '签到拍照' ),

            ),
            'editMeeting' => array(
                'token' => array('name' => 'token', 'type' => 'string', 'require' => true, 'desc' => '用户token'),
                'meetingName' 	=> array('name' => 'meetingName',  'type' => 'string', 'require' => true, 'desc' => '会议主题' ),
                'lecturer' 	=> array('name' => 'lecturer',  'type' => 'string', 'require' => true, 'desc' => '讲师' ),
                'introduction' 	=> array('name' => 'introduction',  'type' => 'string', 'require' => true, 'desc' => '讲师简介' ),
                'time' 	=> array('name' => 'time',  'type' => 'string', 'require' => true, 'desc' => '时间' ),
                'meetingRoom' 	=> array('name' => 'meetingRoom',  'type' => 'string', 'require' => true, 'desc' => '地点' ),
                'inchargeDept' 	=> array('name' => 'inchargeDept',  'type' => 'string', 'require' => true, 'desc' => '主办部门' ),
                'organizer' 	=> array('name' => 'organizer',  'type' => 'string', 'require' => true, 'desc' => '组织者' ),
                'content' 	=> array('name' => 'content',  'type' => 'string', 'require' => true, 'desc' => '会议内容' ),
                'members' 	=> array('name' => 'members',  'type' => 'string', 'require' => true, 'desc' => '参会人员' ),
                'protocol' 	=> array('name' => 'protocol',  'type' => 'string', 'require' => true, 'desc' => '培训协议' ),
                'test' 	=> array('name' => 'test',  'type' => 'string', 'require' => true, 'desc' => '随堂考试' ),
                'beginTime' 	=> array('name' => 'beginTime',  'type' => 'string', 'require' => true, 'desc' => '会议开始日期' ),
                'endTime' 	=> array('name' => 'endTime',  'type' => 'string', 'require' => true, 'desc' => '会议结束日期' ),
                'id' 	=> array('name' => 'id',  'type' => 'string', 'require' => true, 'desc' => '会议ID' ),
                'hasPhoto' 	=> array('name' => 'hasPhoto',  'type' => 'string', 'require' => true, 'desc' => '签到拍照' ),

            ),
            'delMeeting' => array(
                'token' => array('name' => 'token', 'type' => 'string', 'require' => true, 'desc' => '用户token'),
                'id' 	=> array('name' => 'id',  'type' => 'string', 'require' => true, 'desc' => '会议ID' ),
            ),
            'getListByCond' => array(
                'token' => array('name' => 'token', 'type' => 'string', 'require' => true, 'desc' => '用户token'),
                'current' => array('name' => 'current', 'type' => 'int', 'require' => false, 'default' => 1, 'desc' => '当前页数'),
                'meetingRoom' => array('name' => 'meetingRoom', 'type' => 'string', 'require' => false, 'desc' => '地点'),
                'meetingName' => array('name' => 'meetingName', 'type' => 'string', 'require' => false, 'desc' => '会议主题'),
                'searchDate' => array('name' => 'searchDate', 'type' => 'string', 'require' => false, 'desc' => '时间'),
                'mStatus' => array('name' => 'mStatus', 'type' => 'string', 'require' => false, 'desc' => '会议状态'),

            ),
            'getRoomInfoList' => array(
                'meetingroom' 	=> array('name' => 'meetingroom',  'type' => 'int', 'require' => true, 'desc' => '所属会议室ID' ),
                'nowtime' 	=> array('name' => 'nowtime',  'type' => 'string', 'require' => true, 'desc' => '当前时间' ),
            ),
            'getMeetingDetail' => array(
                'id' 	=> array('name' => 'id',  'type' => 'int', 'require' => true, 'desc' => '所属会议ID' ),
            ),
            'startMeeting'=> array(
                'id' 	=> array('name' => 'id',  'type' => 'int', 'require' => true, 'desc' => '所属会议ID' ),
            ),
            'endMeeting'=> array(
                'id' 	=> array('name' => 'id',  'type' => 'int', 'require' => true, 'desc' => '所属会议ID' ),
            ),
            'getSignInStaff'=> array(
                'id' 	=> array('name' => 'id',  'type' => 'int', 'require' => true, 'desc' => '所属会议ID' ),
            ),
        );
    }

    /**
     * 查询会议列表
     * @desc 用于查询会议列表
     * @return int code 操作码，1表示成功， 0表示失败
     * @return string msg 提示信息
     */
    public function getListByCond() {
        Common_GetReturn::checkToken($this->token);
        $domain=new Domain_Meeting();
        $data=$domain->getListByCond($this->current,$this->meetingRoom,$this->meetingName,$this->searchDate,$this->mStatus);
        return $data;
    }

    /**
     * 添加会议
     * @desc 添加会议
     * @return int code 操作码，1表示成功， 0表示失败
     * @return string msg 提示信息
     */
    public function addMeeting()
    {
        Common_GetReturn::checkToken($this->token);
        $rs = array('code' => 1, 'msg' => '', 'list' => []);
        $domain = new Domain_Meeting();
        $list = $domain->add($this);
        if (!$list['code']) {
            $rs['code'] = 0;
            $rs['msg'] = $list['msg'];
            return $rs;
        }
        return $rs;
    }

    /**
     * 查询所属会议室会议列表
     * @desc 用于查询会议列表
     * @return int code 操作码，1表示成功， 0表示失败
     * @return string msg 提示信息
     */
    public function getRoomInfoList() {
        $domain=new Domain_Meeting();
        $data=$domain->getRoomInfoList($this->meetingroom,$this->nowtime);
        $rs['data']=$data;
        return $rs;
    }

    /**
     * 编辑会议
     * @desc 编辑会议
     * @return int code 操作码，1表示成功， 0表示失败
     * @return string msg 提示信息
     */

    public function editMeeting(){
        Common_GetReturn::checkToken($this->token);
        $rs = array('code' => 1, 'msg' => '', 'list' => []);

        $domain=new Domain_Meeting();
        $list=$domain->edit($this);
        if (!$list['code']){
            $rs['code']=0;
            $rs['msg']=$list['msg'];
            return $rs;
        }
        return $rs;
    }



    /**
     * 删除会议
     * @desc 删除会议
     * @return int code 操作码，1表示成功， 0表示失败
     * @return string msg 提示信息
     */
    public function delMeeting(){
        Common_GetReturn::checkToken($this->token);
        $rs = array('code' => 1, 'msg' => '', 'list' => [], 'departments' => []);
        $domain = new Domain_Meeting();
        $rel = $domain->del($this->id);
        if (!$rel['code']) {
            $rs['code'] = 0;
            $rs['msg'] = $rel['msg'];
            return $rs;
        }
        return $rs;
    }

    /**
     * 查询所点击会议详情
     * @desc 用于查询所点击会议详情
     * @return int code 操作码，1表示成功， 0表示失败
     * @return string msg 提示信息
     */
      public function getMeetingDetail(){
          $domain = new Domain_Meeting();
          $data = $domain->getMeetingDetail($this->id);
          $rs['data'] = $data;
          return $rs;
      }



    /**
     * 开始会议
     * @desc 开始会议
     * @return int code 操作码，1表示成功， 0表示失败
     * @return string msg 提示信息
     */

      public function startMeeting(){
          $rs = array('code' => 1, 'msg' => '');
          $domain = new Domain_Meeting();
          $data = $domain->startMeeting($this->id);
          if (!$data['code']){
              $rs['code']=0;
              $rs['msg']='失败';
              return $rs;
          }
          return $rs;
      }

    /**
     * 结束会议
     * @desc 结束会议
     * @return int code 操作码，1表示成功， 0表示失败
     * @return string msg 提示信息
     */

    public function endMeeting(){
        $rs = array('code' => 1, 'msg' => '');
        $domain = new Domain_Meeting();
        $data = $domain->endMeeting($this->id);
        if (!$data['code']){
            $rs['code']=0;
            $rs['msg']='失败';
            return $rs;
        }
        return $rs;
    }

    /**
     * 查看会议签到人员列表
     * @desc 查看会议签到人员列表
     * @return int code 操作码，1表示成功， 0表示失败
     * @return string msg 提示信息
     */

    public function getSignInStaff(){
        $rs = array('code' => 1, 'msg' => '','list'=>[]);
        $domain = new Domain_Meeting();
        $data = $domain->getSignInStaff($this->id);
        $rs['list']=$data;

        return $rs;
    }
 }