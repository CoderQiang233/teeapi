<?php
/**
 * 会员管理
 * Created by PhpStorm.
 * User: ${zhouyuan}
 * Date: 2018/9/26
 * Time: 14:32
 */

class Api_Member extends PhalApi_Api {
    public function getRules() {
        return array(
            'getMemberList' => array(
                'name' => array('name' => 'name', 'type' => 'string', 'require' => false, 'desc' => '姓名'),
                'phone' => array('name' => 'phone', 'type' => 'string', 'require' => false, 'desc' => '手机号码'),
                'level' => array('name' => 'level', 'type' => 'string', 'require' => false, 'desc' => '会员等级'),
                'pageSize'=> array('name' => 'pageSize',  'type' => 'int', 'require' => true, 'desc' => '每页条数'),
                'pageIndex'=> array('name' => 'pageIndex', 'type' => 'int', 'require' => true,  'desc' => '跳转页码'),
            ),
            'getMemberLevelCount' => array(
            ),
        );
    }

    /**
     * 获取会员信息列表
     * @desc 获取会员信息列表
     * @return int code 操作码，1表示成功， 0表示失败 2 表示验证失败
     * @return string msg 提示信息
     */

    public function getMemberList(){
        $rs = array('code' => 1, 'msg' => '','list'=>[]);

        $domain = new Domain_Member();
        $rel=$domain->getMemberList($this);


        $rs['list']=$rel;

        return $rs;

    }
    /**
     * 获取不同会员等级下的注册人数信息
     * @desc 获取不同会员等级下的注册人数信息
     * @return int code 操作码，1表示成功， 0表示失败 2 表示验证失败
     * @return string msg 提示信息
     */

    public function getMemberLevelCount(){
        $rs = array('code' => 1, 'msg' => '','list'=>[]);

        $domain = new Domain_Member();
        $rel=$domain->getMemberLevelCount($this);


        $rs['list']=$rel;

        return $rs;

    }




}