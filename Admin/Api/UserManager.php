<?php
/**
 * 用户管理相关接口
 * User: Administrator
 * Date: 2018/5/21
 * Time: 11:45
 */
class Api_UserManager extends PhalApi_Api {
    public function getRules() {
        return array(
            'getUserList' => array(
                'departmentId' => array('name' => 'departmentId', 'type' => 'string', 'require' => false, 'desc' => '部门id'),
                'phoneNum' => array('name' => 'phoneNum', 'type' => 'string', 'require' => false, 'desc' => '联系电话'),
                'role' => array('name' => 'role', 'type' => 'string', 'require' => false, 'desc' => '用户权限'),

            ),
            'addUser' => array(
                'userName' => array('name' => 'userName', 'type' => 'string', 'require' => true, 'desc' => '用户名'),
                'name' => array('name' => 'name', 'type' => 'string', 'require' => true, 'desc' => '姓名'),
                'tel' => array('name' => 'tel', 'type' => 'string', 'require' => true, 'desc' => '联系电话'),
//                'department' => array('name' => 'department', 'type' => 'string', 'require' => true, 'desc' => '部门'),
                'pwd' => array('name' => 'pwd', 'type' => 'string', 'require' => true, 'desc' => '密码'),
                'role' => array('name' => 'role', 'type' => 'string', 'require' => true, 'desc' => '角色'),

            ),
            'deleteUser'=>array(
                'userId' => array('name' => 'userId', 'type' => 'string', 'require' => true, 'desc' => '人员id'),
            ),
            'editUser' => array(
                'userName' => array('name' => 'userName', 'type' => 'string', 'require' => true, 'desc' => '用户名'),
                'name' => array('name' => 'name', 'type' => 'string', 'require' => true, 'desc' => '姓名'),
                'tel' => array('name' => 'tel', 'type' => 'string', 'require' => true, 'desc' => '联系电话'),
//                'department' => array('name' => 'department', 'type' => 'string', 'require' => true, 'desc' => '部门'),
                'role' => array('name' => 'role', 'type' => 'string', 'require' => true, 'desc' => '角色'),
                'userId' => array('name' => 'userId', 'type' => 'string', 'require' => true, 'desc' => '用户id'),
            ),
            'getCurrentUser' => array(
                'token' => array('name' => 'token', 'type' => 'string', 'require' => true, 'desc' => '用户token'),
            ),
            'editPwd' => array(
                'oPwd' => array('name' => 'oPwd', 'type' => 'string', 'require' => true, 'desc' => '旧密码'),
                'nPwd' => array('name' => 'nPwd', 'type' => 'string', 'require' => true, 'desc' => '新密码'),

                'confirm' => array('name' => 'confirm', 'type' => 'string', 'require' => true, 'desc' => '确认新密码'),
                'userId' => array('name' => 'userId', 'type' => 'string', 'require' => true, 'desc' => '用户id'),

            ),
            'adminEditPwd' => array(
            'nPwd' => array('name' => 'nPwd', 'type' => 'string', 'require' => true, 'desc' => '新密码'),
            'confirm' => array('name' => 'confirm', 'type' => 'string', 'require' => true, 'desc' => '确认新密码'),
            'userId' => array('name' => 'userId', 'type' => 'string', 'require' => true, 'desc' => '用户id'),

        ),
        );
    }


    /**
     * 获取用户列表
     * @desc 获取用户列表
     * @return int code 操作码，1表示成功， 0表示失败
     * @return string msg 提示信息
     */
    public function getUserList(){
        $rs = array('code' => 1, 'msg' => '', 'list' => []);
        $domain=new Domain_UserManager();
        $list=$domain->getUserList($this);


        $rs['list']=$list;
        return $rs;
    }

    /**
     * 获取部门列表
     * @desc 获取部门列表
     * @return int code 操作码，1表示成功， 0表示失败
     * @return string msg 提示信息
     */
    public function getDepartments(){
        $rs = array('code' => 1, 'msg' => '', 'list' => []);
        $domain=new Domain_Department();
        $list=$domain->getDepartments();


        $rs['list']=$list;
        return $rs;
    }


    /**
     * 添加用户
     * @desc 添加用户
     * @return int code 操作码，1表示成功， 0表示失败
     * @return string msg 提示信息
     */
    public function addUser(){
        $rs = array('code' => 1, 'msg' => '', 'list' => []);
        $domain=new Domain_UserManager();
        $list=$domain->addUser($this);
        if (!$list['code']){
            $rs['code']=0;
            $rs['msg']=$list['msg'];
            return $rs;
        }

        $rs['list']=$list['data'];
        return $rs;
    }

    /**
     * 编辑用户
     * @desc 编辑用户
     * @return int code 操作码，1表示成功， 0表示失败
     * @return string msg 提示信息
     */

    public function editUser(){
        $rs = array('code' => 1, 'msg' => '', 'list' => []);
        $domain=new Domain_UserManager();
        $list=$domain->editUser($this);
        if (!$list['code']){
            $rs['code']=0;
            $rs['msg']=$list['msg'];
            return $rs;
        }

        $rs['list']=$list['data'];
        return $rs;
    }


//    public function editPwd(){
//        $rs = array('code' => 1, 'msg' => '');
//        $domain=new Domain_UserManager();
//        $list=$domain->editUser($this);
//        if (!$list['code']){
//            $rs['code']=0;
//            $rs['msg']=$list['msg'];
//            return $rs;
//        }
//
//        return $rs;
//    }


    /**
     * 删除组织机构
     * @desc 删除组织机构
     * @return int code 操作码，1表示成功， 0表示失败
     * @return string msg 提示信息
     */
    public function deleteUser(){
        $rs = array('code' => 1, 'msg' => '', 'list' => [],);
        $domain=new Domain_UserManager();
        $rel=$domain->deleteUser($this);
        if(!$rel['code']){
            $rs['code']=0;
            $rs['msg']=$rel['msg'];
            return $rs;
        }
        $rs['list']=$rel['data'];
        return $rs;
    }

    /**
     * 获取当前登录用户信息
     * @desc 获取当前登录用户信息
     * @return int code 操作码，1表示成功， 0表示失败
     * @return string msg 提示信息
     */
    public function getCurrentUser(){
        $rs = array('code' => 1, 'msg' => '', 'user' => [],);
        $user = Common_GetReturn::checkToken($this->token);
        $user->avatar='https://gw.alipayobjects.com/zos/rmsportal/BiazfanxmamNRoxxVxka.png';
        $rs['user']=$user;
        return $rs;
    }



    public function editPwd(){
        $rs = array('code' => 1, 'msg' => '');
        $domain=new Domain_UserManager();
        $rel=$domain->editPwd($this);
        if (!$rel['code']){
            $rs['code']=0;
            $rs['msg']=$rel['msg'];
            return $rs;
        }
        return $rs;
    }

    /**
     * 超级管理员修改密码
     * @return array
     */
    public function adminEditPwd(){
        $rs = array('code' => 1, 'msg' => '');
        $domain=new Domain_UserManager();
        $rel=$domain->adminEditPwd($this);
        if (!$rel['code']){
            $rs['code']=0;
            $rs['msg']=$rel['msg'];
            return $rs;
        }
        return $rs;
    }
}