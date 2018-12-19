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
                'phone' => array('name' => 'phone', 'type' => 'string', 'require' => false, 'desc' => '手机号码'),
                'pageSize'=> array('name' => 'pageSize',  'type' => 'int', 'require' => true, 'desc' => '每页条数'),
                'pageIndex'=> array('name' => 'pageIndex', 'type' => 'int', 'require' => true,  'desc' => '跳转页码'),
            ),
            'getMemberLevelCount' => array(
            ),
        );
    }


    public function getMemberList(){
        $rs = array('code' => 0, 'msg' => '', 'info' => array());

        $domain = new Domain_Member();

        $result = $domain->getList($this);

        if(is_array($result)){

            $rs['code'] = 1;

            $rs['info'] = $result;
        }

        return $rs;
    }




}