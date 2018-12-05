<?php
/**
 * 组织机构管理相关接口
 * User: Administrator
 * Date: 2018/5/16
 * Time: 17:39
 */
class Api_Department extends PhalApi_Api {
    public function getRules() {
        return array(
            'getDepartmentList' => array(
                'departmentId' => array('name' => 'departmentId', 'type' => 'string', 'require' => false, 'desc' => '部门id'),
                'phoneNum' => array('name' => 'phoneNum', 'type' => 'string', 'require' => false, 'desc' => '联系电话'),
            ),
            'addDepartment' => array(
                'deptName' => array('name' => 'deptName', 'type' => 'string', 'require' => true, 'desc' => '部门名称'),
                'deptCode' => array('name' => 'deptCode', 'type' => 'string', 'require' => false, 'desc' => '编码'),
                'numbers' => array('name' => 'numbers', 'type' => 'string', 'require' => false, 'desc' => '人数'),
                'incharge' => array('name' => 'incharge', 'type' => 'string', 'require' => false, 'desc' => '负责人'),
                'inchargeTel' => array('name' => 'inchargeTel', 'type' => 'string', 'require' => false, 'desc' => '电话'),

            ),
            'deleteDepartment'=>array(
                'departmentId' => array('name' => 'departmentId', 'type' => 'string', 'require' => true, 'desc' => '部门id'),
            ),
            'editDepartment' => array(
                'deptName' => array('name' => 'deptName', 'type' => 'string', 'require' => false, 'desc' => '部门名称'),
                'deptCode' => array('name' => 'deptCode', 'type' => 'string', 'require' => false, 'desc' => '编码'),
                'numbers' => array('name' => 'numbers', 'type' => 'string', 'require' => false, 'desc' => '人数'),
                'incharge' => array('name' => 'incharge', 'type' => 'string', 'require' => false, 'desc' => '负责人'),
                'inchargeTel' => array('name' => 'inchargeTel', 'type' => 'string', 'require' => false, 'desc' => '电话'),
                'departmentId' => array('name' => 'departmentId', 'type' => 'string', 'require' => true, 'desc' => '部门id'),
            ),
        );
    }


    /**
     * 获取组织机构列表
     * @desc 获取组织机构列表
     * @return int code 操作码，1表示成功， 0表示失败
     * @return string msg 提示信息
     */
    public function getDepartmentList(){
        $rs = array('code' => 1, 'msg' => '', 'list' => [],'departments'=>[]);
        $domain=new Domain_Department();
        $list=$domain->getDepartmentList($this);
        $departments=$domain->getDepartments();

        $rs['list']=$list;
        $rs['departments']=$departments;
        return $rs;
    }
    /**
     * 添加组织机构
     * @desc 添加组织机构
     * @return int code 操作码，1表示成功， 0表示失败
     * @return string msg 提示信息
     */
    public function addDepartment(){
        $rs = array('code' => 1, 'msg' => '', 'list' => [],'departments'=>[]);
        $domain=new Domain_Department();
        $list=$domain->addDepartment($this);
        if (!$list['code']){
            $rs['code']=0;
            $rs['msg']=$list['msg'];
            return $rs;
        }
        $departments=$domain->getDepartments();

        $rs['list']=$list['data'];
        $rs['departments']=$departments;
        return $rs;
    }

    /**
     * 编辑组织机构
     * @desc 编辑组织机构
     * @return int code 操作码，1表示成功， 0表示失败
     * @return string msg 提示信息
     */

    public function editDepartment(){
        $rs = array('code' => 1, 'msg' => '', 'list' => [],'departments'=>[]);
        $domain=new Domain_Department();
        $list=$domain->editDepartment($this);
        if (!$list['code']){
            $rs['code']=0;
            $rs['msg']=$list['msg'];
            return $rs;
        }
        $departments=$domain->getDepartments();

        $rs['list']=$list['data'];
        $rs['departments']=$departments;
        return $rs;
    }



    /**
     * 删除组织机构
     * @desc 删除组织机构
     * @return int code 操作码，1表示成功， 0表示失败
     * @return string msg 提示信息
     */
    public function deleteDepartment(){
        $rs = array('code' => 1, 'msg' => '', 'list' => [],'departments'=>[]);
        $domain=new Domain_Department();
        $rel=$domain->deleteDepartment($this);
        if(!$rel['code']){
            $rs['code']=0;
            $rs['msg']=$rel['msg'];
            return $rs;
        }
        $rs['list']=$rel['data'];
        $departments=$domain->getDepartments();
        $rs['departments']=$departments;
        return $rs;
    }
}