<?php
/**
 * 推广返现
 * Created by PhpStorm.
 * User: ${zhouyuan}
 * Date: 2018/10/19
 * Time: 10:45
 */



class Api_AgentCashback extends PhalApi_Api {
    public function getRules() {
        return array(
            'getPromoterList' => array(
                'phone' => array('name' => 'phone', 'type' => 'string', 'require' => false, 'desc' => '手机号码'),
                'nick_name' => array('name' => 'nick_name', 'type' => 'string', 'require' => false, 'desc' => '微信昵称'),
                'pageSize'=> array('name' => 'pageSize',  'type' => 'int', 'require' => true, 'desc' => '每页条数'),
                'pageIndex'=> array('name' => 'pageIndex', 'type' => 'int', 'require' => true,  'desc' => '跳转页码'),
            ),

        );
    }

    /**
     * 获取推客可用返现信息
     */
    public function getPromoterList(){
        $rs = array('code' => 0, 'msg' => '', 'info' => array());

        $domain = new Domain_AgentCashback();

        $result = $domain->getList($this);

        if(is_array($result)){

            $rs['code'] = 1;

            $rs['info'] = $result;
        }

        return $rs;
    }





}