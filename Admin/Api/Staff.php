<?php
/**
 * 人员管理相关接口
 * User: Administrator
 * Date: 2018/5/21
 * Time: 11:45
 */
class Api_Staff extends PhalApi_Api {
    public function getRules() {
        return array(
            'getStaffList' => array(
                'departmentId' => array('name' => 'departmentId', 'type' => 'string', 'require' => false, 'desc' => '部门id'),
                'jobNum' => array('name' => 'jobNum', 'type' => 'string', 'require' => false, 'desc' => '工号'),
            ),
            'addStaff' => array(
                'name' => array('name' => 'name', 'type' => 'string', 'require' => true, 'desc' => '姓名'),
                'sex' => array('name' => 'sex', 'type' => 'string', 'require' => false, 'desc' => '性别'),
//                'age' => array('name' => 'age', 'type' => 'string', 'require' => false, 'desc' => '年龄'),
                'phoneNum' => array('name' => 'phoneNum', 'type' => 'string', 'require' => false, 'desc' => '联系方式'),
                'department' => array('name' => 'department', 'type' => 'string', 'require' => true, 'desc' => '部门'),
                'position' => array('name' => 'position', 'type' => 'string', 'require' => false, 'desc' => '岗位'),
                'email' => array('name' => 'email', 'type' => 'string', 'require' => false, 'desc' => '电子邮箱'),
                'jobNum' => array('name' => 'jobNum', 'type' => 'string', 'require' => false, 'desc' => '工号'),

            ),
            'deleteStaff'=>array(
                'staffId' => array('name' => 'staffId', 'type' => 'string', 'require' => true, 'desc' => '人员id'),
            ),
            'editStaff' => array(
                'name' => array('name' => 'name', 'type' => 'string', 'require' => true, 'desc' => '姓名'),
                'sex' => array('name' => 'sex', 'type' => 'string', 'require' => false, 'desc' => '性别'),
//                'age' => array('name' => 'age', 'type' => 'string', 'require' => false, 'desc' => '年龄'),
                'phoneNum' => array('name' => 'phoneNum', 'type' => 'string', 'require' => false, 'desc' => '联系方式'),
                'department' => array('name' => 'department', 'type' => 'string', 'require' => true, 'desc' => '部门'),
                'position' => array('name' => 'position', 'type' => 'string', 'require' => false, 'desc' => '岗位'),
                'email' => array('name' => 'email', 'type' => 'string', 'require' => false, 'desc' => '电子邮箱'),
                'jobNum' => array('name' => 'jobNum', 'type' => 'string', 'require' => false, 'desc' => '工号'),
                'staffId' => array('name' => 'staffId', 'type' => 'string', 'require' => false, 'desc' => '职工id'),
            ),
            'getStaffTree' => array(
                'token' => array('name' => 'token', 'type' => 'string', 'require' => true, 'desc' => '用户token'),
            ),
            'uploadExcel'=> array(
                'execlFile' => array(
                    'name' => 'execlFile',
                    'type' => 'file',
                    'min' => 0,
                ),
            ),
            'importStaff' => array(
                'filePath' => array('name' => 'filePath', 'type' => 'string', 'require' => true, 'desc' => '文件路径'),
            ),
        );
    }


    /**
     * 获取人员列表
     * @desc 获取人员列表
     * @return int code 操作码，1表示成功， 0表示失败
     * @return string msg 提示信息
     */
    public function getStaffList(){
        $rs = array('code' => 1, 'msg' => '', 'list' => []);
        $domain=new Domain_Staff();
        $list=$domain->getStaffList($this);


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
     * 添加人员
     * @desc 添加人员
     * @return int code 操作码，1表示成功， 0表示失败
     * @return string msg 提示信息
     */
    public function addStaff(){
        $rs = array('code' => 1, 'msg' => '', 'list' => []);
        $domain=new Domain_Staff();
        $list=$domain->addStaff($this);
        if (!$list['code']){
            $rs['code']=0;
            $rs['msg']=$list['msg'];
            return $rs;
        }

        $rs['list']=$list['data'];
        return $rs;
    }

    /**
     * 编辑人员
     * @desc 编辑人员
     * @return int code 操作码，1表示成功， 0表示失败
     * @return string msg 提示信息
     */

    public function editStaff(){
        $rs = array('code' => 1, 'msg' => '', 'list' => []);
        $domain=new Domain_Staff();
        $list=$domain->editStaff($this);
        if (!$list['code']){
            $rs['code']=0;
            $rs['msg']=$list['msg'];
            return $rs;
        }

        $rs['list']=$list['data'];
        return $rs;}


    /**
     * 查询人员树列表
     * @desc 用于查询人员树列表
     * @return int code 操作码，1表示成功， 0表示失败
     * @return string msg 提示信息
     */
    public function getStaffTree() {
        Common_GetReturn::checkToken($this->token);
        $domain=new Domain_Staff();
        $data=$domain->getStaffTree();
        return $data;
    }



    /**
     * 删除组织机构
     * @desc 删除组织机构
     * @return int code 操作码，1表示成功， 0表示失败
     * @return string msg 提示信息
     */
    public function deleteStaff(){
        $rs = array('code' => 1, 'msg' => '', 'list' => [],);
        $domain=new Domain_Staff();
        $rel=$domain->deleteStaff($this);
        if(!$rel['code']){
            $rs['code']=0;
            $rs['msg']=$rel['msg'];
            return $rs;
        }
        $rs['list']=$rel['data'];
        return $rs;
    }


    /**
     * 上传execl文件
     * @return array
     */
    public function uploadExcel(){
        //设置上传路径 设置方法参考3.2
        DI()->ucloud->set('save_path','execlFile');
        //上传表单名
        $rs = DI()->ucloud->upfile($this->execlFile);

        return $rs;
    }

    /**
     * 批量导入
     * @return array
     */

    public function importStaff(){
        $rs = array('code' => 1, 'msg' => '', 'list' => [],);
//        $domain=new Domain_Staff();
//        $rel=$domain->deleteStaff($this);
        $PHPExcel = new PHPExcel_Lite();
        $filename=dirname(__FILE__).'/../../Public/upload/'.$this->filePath;
        $data=$PHPExcel->importExcel($filename);
//        return $data;
        $domain=new Domain_Staff();
        $rel=$domain->importStaff($data);
        $rs['list']=$data;
        return $rel;
    }
}