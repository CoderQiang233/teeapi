<?php

/**
 * 通知协议管理
 * User: lxl
 * Date: 2018/7/20
 * Time: 上午11:01
 */
class Api_Notice extends PhalApi_Api
{

        public function getHomeNotice(){

            $rs = array('code' => 0, 'msg' => '', 'info' => array());

            $domain = new Domain_Notice();

            $rs['code'] = 1;

            $rs['info'] = $domain -> getHomeNotice();

            return $rs;



        }

}