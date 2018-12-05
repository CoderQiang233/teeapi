<?php

/**
 * 会员中心
 */
class Api_me extends PhalApi_Api{


    public function getRules() {
        return array(
            'index' => array(
                'session3rd' 	=> array('name' => 'session3rd', 'type' =>'string', 'require' => true,'source' => 'post')
            ),
            'getkucun' => array(
                'session3rd' 	=> array('name' => 'session3rd', 'type' =>'string', 'require' => true,'source' => 'post')
            ),
            'getfanxian' => array(
                'session3rd' 	=> array('name' => 'session3rd', 'type' =>'string', 'require' => true,'source' => 'post'),
                'curentmonth' 	=> array('name' => 'curentmonth', 'type' =>'string', 'require' => false,'source' => 'post')
            ),
            'GetQualification' => array(
                'session3rd' 	=> array('name' => 'session3rd', 'type' =>'string', 'require' => true),

            )
        );
    }

    /**
     * 通过session查用户信息
     */
    public function index(){
        $rs = array('code' => 0, 'msg' => '', 'info' => array());
        $session = DI()->wechatMini->getSession($this->session3rd);
        if(isset($session['openid'])){
            $domain = new Domain_Me();
            $result = $domain ->index($session['openid']);
            if($result){
                $rs['code'] = 1;

                $rs['info'] = $result;
            }
        }
        return $rs;
    }

    /**
     * 通过session查用户库存
     */
    public function getkucun(){
        $rs = array('code' => 0, 'msg' => '', 'info' => array());
        $session = DI()->wechatMini->getSession($this->session3rd);
        if(isset($session['openid'])){
            $domain = new Domain_Me();
            $result = $domain ->getkucun($session['openid']);
            if($result){
                $rs['code'] = 1;

                $rs['info'] = $result;
            }
        }
        return $rs;
    }

    /**
     * 通过session查返现明细
     */
    public function getfanxian(){
        $rs = array('code' => 0, 'msg' => '', 'info' => array());
        $session = DI()->wechatMini->getSession($this->session3rd);
        if(isset($session['openid'])){
            $domain = new Domain_Me();
            $result = $domain ->getfanxian($session['openid'],$this->curentmonth);
            if($result){
                $rs['code'] = 1;

                $rs['info'] = $result;
            }
        }
        return $rs;
    }
    /**
     * 通过session查看用户是否具有升级资格
     */
    public function GetQualification(){
        $session = DI()->wechatMini->getSession($this->session3rd);
        if(isset($session['openid'])){
            $domain = new Domain_Me();
            $result = $domain ->GetQualification($session['openid']);

                $rs=$result;

        }
        return $rs;
    }



}