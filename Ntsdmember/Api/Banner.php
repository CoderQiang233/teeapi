<?php

/**
 * banner管理
 */
class Api_Banner extends PhalApi_Api
{

    public function getbanners(){

        $rs = array('code' => 0, 'msg' => '', 'info' => array());

        $domain = new Domain_Banner();

        $rs['code'] = 1;

        $rs['info'] = $domain ->getbanners();

        return $rs;
    }

}