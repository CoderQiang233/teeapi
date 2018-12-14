<?php
/**
 * Created by PhpStorm.
 * User: zy
 * Date: 2018/9/20
 * Time: 10:38
 */


/**
 * 我的地址接口
 */
class Api_MyAddresss extends PhalApi_Api
{

    public function getRules() {
        return array(
            'insertMyAddresss' => array(
                'consignee_name' => array('name'=>'consignee_name','type' =>'string','require' => true,'source' => 'post','desc'=>'收货人姓名'),
                'address' => array('name'=>'address','type' =>'string','require' => true,'source' => 'post','desc'=>'详细地址'),
                'consignee_phone' => array('name'=>'consignee_phone','type' =>'string','require' => true,'source' => 'post',
                    'min' => '11',
                    'regex' => "/^0?(13|14|15|17|18)[0-9]{9}$/",'desc'=>'收货人手机号'),
                'member_id' =>array('name'=>'member_id','type' =>'string','require' => true,'source' => 'post','desc'=>'会员id'),
                'session3rd' =>array('name'=>'session3rd','type' =>'string','require' => true,'source' => 'post','desc'=>'session3rd'),
                'city' =>array('name'=>'city','type' =>'string','require' => true,'source' => 'post','desc'=>'市'),
                'county' =>array('name'=>'county','type' =>'string','require' => true,'source' => 'post','desc'=>'区'),
                'province' =>array('name'=>'province','type' =>'string','require' => true,'source' => 'post','desc'=>'省'),
                'state' =>array('name'=>'state','type' =>'string','require' => true,'source' => 'post','desc'=>'是否为默认地址(0:不是,1:是)'),
            ),
            'findAddressByMemberId' => array(
                'member_id' =>array('name'=>'member_id','type' =>'string','require' => true,'source' => 'post','desc'=>'会员id'),
            ),
            'findAddressById'=>array(
                'id'=>array('name'=>'id','type' =>'string','require' => true,'source' => 'post','desc'=>'id'),
            ),
            'updateAddressById'=>array(
                'id'=>array('name'=>'id','type' =>'string','require' => true,'source' => 'post','desc'=>'id'),
                'consignee_name' => array('name'=>'consignee_name','type' =>'string','require' => true,'source' => 'post','desc'=>'收货人姓名'),
                'address' => array('name'=>'address','type' =>'string','require' => true,'source' => 'post','desc'=>'详细地址'),
                'consignee_phone' => array('name'=>'consignee_phone','type' =>'string','require' => true,'source' => 'post',
                    'min' => '11',
                    'regex' => "/^0?(13|14|15|17|18)[0-9]{9}$/",'desc'=>'收货人手机号'),
                'city' =>array('name'=>'city','type' =>'string','require' => true,'source' => 'post','desc'=>'市'),
                'county' =>array('name'=>'county','type' =>'string','require' => true,'source' => 'post','desc'=>'区'),
                'province' =>array('name'=>'province','type' =>'string','require' => true,'source' => 'post','desc'=>'省'),
                'state' =>array('name'=>'state','type' =>'string','require' => true,'source' => 'post','desc'=>'是否为默认地址(0:不是,1:是)'),
                'member_id' =>array('name'=>'member_id','type' =>'string','require' => true,'source' => 'post','desc'=>'会员id'),
            ),
            'deleteAddressById'=>array(
                'id'=>array('name'=>'id','type' =>'string','require' => true,'source' => 'post','desc'=>'id'),
            ),
            'getDefaultAddress'=>array(
                'session3rd' =>array('name'=>'session3rd','type' =>'string','require' => true,'source' => 'post','desc'=>'session3rd'),
            ),
        );
    }


    /**
     * 新增收货地址
     */
    public function insertMyAddresss(){

        $rs = array('code' => 0, 'msg' => '', 'info' => array());

        $session = DI()->wechatMini->getSession($this->session3rd);

        $this->openid=$session['openid'];

        $domain = new Domain_MyAddresss();

        $res = $domain->insertMyAddresss($this);

        if($res){

            $rs['code'] = 1;

            $rs['info'] = $res;
        }
        return $rs;
    }

    /**
     * 通过会员id查看地址信息
     */
    public function findAddressByMemberId(){

        $rs = array('code' => 0, 'msg' => '', 'info' => array());

        $domain = new Domain_MyAddresss();

        $res = $domain->findAddressByMemberId($this);

        if(is_array($res)){

            $rs['code'] = 1;

            $rs['info'] = $res;
        }
        return $rs;
    }

    /**
     * 通过id查看我的单个地址信息
     */
    public function findAddressById(){

        $rs = array('code' => 0, 'msg' => '', 'info' => array());

        $domain = new Domain_MyAddresss();

        $res = $domain->findAddressById($this);

        if($res){

            $rs['code'] = 1;

            $rs['info'] = $res;
        }
        return $rs;
    }

    /**
     * 通过id修改单个收货信息
     */
    public function updateAddressById(){

        $rs = array('code' => 0, 'msg' => '', 'info' => array());

        $domain = new Domain_MyAddresss();

        $res = $domain->updateAddressById($this);

        if($res){

            $rs['code'] = 1;

            $rs['info'] = $res;
        }
        return $rs;
    }


    /**
     * 通过id删除单个地址信息
     */
    public function deleteAddressById(){

        $rs = array('code' => 0, 'msg' => '', 'info' => array());

        $domain = new Domain_MyAddresss();

        $res = $domain->deleteAddressById($this);

        if($res){

            $rs['code'] = 1;

            $rs['info'] = $res;
        }
        return $rs;

    }

    /**
     * 获取默认地址
     */
    public function getDefaultAddress(){

        $rs = array('code' => 0, 'msg' => '', 'info' => array());

        $domain = new Domain_MyAddresss();

        $session = DI()->wechatMini->getSession($this->session3rd);

        $this->openid=$session['openid'];

        $res = $domain->getDefaultAddress($this);

        if($res){

            $rs['code'] = 1;

            $rs['info'] = $res;
        }
        return $rs;
    }


}