<?php

/**
 * 会员注册
 *
 * @author: dogstar <chanzonghuang@gmail.com> 2014-10-04
 */
class Api_Member  extends PhalApi_Api{


    public function getRules() {
        return array(
            'getById' => array(
                'id' 	=> array('name' => 'id', 'type' =>'string', 'require' => true)
            ),
            'checkPhone' => array(
                'phone' 	=> array('name' => 'phone', 'type' =>'string', 'require' => true)
            ),
            'checkRefereePhone' => array(
                'referee_phone' 	=> array('name' => 'phone', 'type' =>'string', 'require' => true)
            ),
            'getrefereeByPhone' => array(
                'phone' 	=> array('name' => 'phone', 'type' =>'string','require' => true)
            ),
            'checkIdcard' => array(
                'idcard' 	=> array('name' => 'idcard', 'type' =>'string', 'require' => true)
            ),

        );
    }


    /**
     * 会员卡信息列表
     * @desc  获取小程序首页会员卡列表
     */
    public function getlist(){

            $member = new Domain_Member();

            $result = $member->getlist();

            return $result;

    }

    /**
     * 单个会员卡信息
     */
    public function getById(){

        $rs = array('code' => 0, 'msg' => '', 'info' => array());

        $id = $this ->id;

        $domain = new Domain_Member();

        $result = $domain->getById($id);

        $rs['code'] = 1;

        $rs['info'] = $result;

        return $rs;


    }

    /**
     * 验证手机号是否注册
     */
    public function checkPhone(){

        $rs = array('code' => 0, 'msg' => '', 'info' => array());

        $phone = $this ->phone;

        $domain = new Domain_Member();

        $result = $domain->checkPhone($phone);
        if(!$result){
            $rs['code'] = 0;

            $rs['info'] = '该手机号未被注册';

            return $rs ;
        }

        $rs['code'] = 1;

        $rs['info'] = $result;

        return $rs;


    }

    /**
     * 验证身份证号是否注册
     */
    public function checkIdcard(){

        $rs = array('code' => 0, 'msg' => '', 'info' => array());

        $idcard = $this ->idcard;

        $domain = new Domain_Member();

        $result = $domain->checkIdcard($idcard);
        if(!$result){
            $rs['code'] = 0;

            $rs['info'] = '身份证号可以使用';

            return $rs ;
        }

        $rs['code'] = 1;

        $rs['info'] = $result;

        return $rs;


    }

    /**
     * 验证推荐人手机号是否为代理
     */
    public function checkRefereePhone(){

        $rs = array('code' => 0, 'msg' => '', 'info' => array());

        $phone = $this ->referee_phone;

        $domain = new Domain_Member();

        $result = $domain->checkRefereePhone($phone);
        if($result){
            $rs['code'] = 0;

            $rs['info'] = $result;

            return $rs ;
        }

        $rs['code'] = 1;

        $rs['info'] = '该推荐人无效';

        return $rs;


    }
    /**
     * 获取我的推荐人信息
     */
    public function getrefereeByPhone(){

        $phone = $this -> phone;

        $rs = array('code' => 0, 'msg' => '', 'info' => array());

        $domain = new Domain_Member();

        $result = $domain -> getrefereeByPhone($phone);

        if($result){



            $rs['code'] = 1;

            $rs['info'] = $result;

        }

        return $rs;


    }








}