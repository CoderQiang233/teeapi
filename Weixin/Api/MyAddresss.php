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
                'openid' =>array('name'=>'openid','type' =>'string','require' => true,'source' => 'post','desc'=>'openid'),
                'city' =>array('name'=>'city','type' =>'string','require' => true,'source' => 'post','desc'=>'市'),
                'county' =>array('name'=>'county','type' =>'string','require' => true,'source' => 'post','desc'=>'区'),
                'province' =>array('name'=>'province','type' =>'string','require' => true,'source' => 'post','desc'=>'省'),
                'state' =>array('name'=>'state','type' =>'string','require' => true,'source' => 'post','desc'=>'是否为默认地址(0:不是,1:是)'),
            ),
            'findAddressByMemberId' => array(
                'member_id' =>array('name'=>'member_id','type' =>'string','require' => true,'source' => 'post','desc'=>'会员id'),
            ),
        );
    }


    /**
     * 新增收货地址
     */
    public function insertMyAddresss(){

        $rs = array('code' => 0, 'msg' => '', 'info' => array());

        $domain = new Domain_MyAddresss();

        $res = $domain->insertMyAddresss($this);

        if($res){

            $rs['code'] = 1;

            $rs['info'] = $res;
        }
        return $rs;
    }

    /**
     * @return array
     * 通过会员id查看地址信息
     */
    public function findAddressByMemberId(){

        $rs = array('code' => 0, 'msg' => '', 'info' => array());

        $domain = new Domain_MyAddresss();

        $res = $domain->insertMyAddresss($this);

        if($res){

            $rs['code'] = 1;

            $rs['info'] = $res;
        }
        return $rs;
    }












}