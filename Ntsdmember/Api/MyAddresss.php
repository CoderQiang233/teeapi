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
            'getMyAddresssById' => array(
                'id' 	=> array('name' => 'id', 'type' =>'string','require' => true)
            ),
            'getMyAddresssBySession3rd' => array(
                'session3rd' 	=> array('name' => 'session3rd', 'type' =>'string','require' => true,'source' => 'post')
            ),
            'updateMyAddresss' => array(
                'consignee_name' => array('name'=>'consignee_name','type' =>'string','require' => true,'source' => 'post'),
                'address' => array('name'=>'address','type' =>'string','require' => true,'source' => 'post'),
                'consignee_phone' => array('name'=>'consignee_phone','type' =>'string','require' => true,'source' => 'post',
                    'min' => '11',
                    'regex' => "/^0?(13|14|15|17|18)[0-9]{9}$/",),
                'member_id' =>array('name'=>'member_id','type' =>'string','require' => true,'source' => 'post'),
                'city' =>array('name'=>'city','type' =>'string','require' => true,'source' => 'post'),
                'county' =>array('name'=>'county','type' =>'string','require' => true,'source' => 'post'),
                'province' =>array('name'=>'province','type' =>'string','require' => true,'source' => 'post'),
            ),
            'insertMyAddresss' => array(
                'consignee_name' => array('name'=>'consignee_name','type' =>'string','require' => true,'source' => 'post'),
                'address' => array('name'=>'address','type' =>'string','require' => true,'source' => 'post'),
                'consignee_phone' => array('name'=>'consignee_phone','type' =>'string','require' => true,'source' => 'post',
                    'min' => '11',
                    'regex' => "/^0?(13|14|15|17|18)[0-9]{9}$/",),
                'member_id' =>array('name'=>'member_id','type' =>'string','require' => true,'source' => 'post'),
                'openid' =>array('name'=>'openid','type' =>'string','require' => true,'source' => 'post'),
                'city' =>array('name'=>'city','type' =>'string','require' => true,'source' => 'post'),
                'county' =>array('name'=>'county','type' =>'string','require' => true,'source' => 'post'),
                'province' =>array('name'=>'province','type' =>'string','require' => true,'source' => 'post'),
            ),
            'inAddress' => array(
                'openid' =>array('name'=>'openid','type' =>'string','require' => true,'source' => 'post'),
            ),
        );
    }

    /**
     * 获取我的地址信息（通过用户id）
     */
    public function getMyAddresssById(){

        $id = $this -> id;

        $rs = array('code' => 0, 'msg' => '', 'info' => array());

        $domain = new Domain_MyAddresss();

        $result = $domain -> getMyAddresssById($id);

        if($result){

            $rs['code'] = 1;

            $rs['info'] = $result;

        }

        return $rs;


    }
    /**
     * 获取我的地址信息（通过openid）
     */
    public function getMyAddresssBySession3rd(){

        $rs = array('code' => 0, 'msg' => '', 'info' => array());

        $session = DI()->wechatMini->getSession($this->session3rd);

        if(isset($session['openid'])){

            $domain = new Domain_MyAddresss();

            $result = $domain ->getMyAddresssBySession3rd($session['openid']);


            if($result){

                $rs['code'] = 1;

                $rs['info'] = $result;

            }


        }
        return $rs;


    }

    public function insertMyAddresss(){


        $rs = array('code' => 0, 'msg' => '', 'info' => array());


        $data = array();

        $data['id'] = time();

        $data['consignee_name'] = $this -> consignee_name;

        $data['address'] = $this -> address;

        $data['consignee_phone'] = $this -> consignee_phone;

        $data['create_time'] = date("Y-m-d",time());

        $data['member_id'] = $this->member_id;

        $data['openid'] = $this->openid;

        $data['city'] = $this -> city;

        $data['county'] = $this -> county;

        $data['province'] = $this -> province;

        $domain = new Domain_MyAddresss();

        $res = $domain->insertMyAddresss($data);

        if($res){

            $rs['code'] = 1;

        }

        return $rs;



    }

    /**
     * 修改我的地址信息
     */
    public function updateMyAddresss(){

        $rs = array('code' => 0, 'msg' => '', 'info' => array());


        $data = array();

        $data['name'] = $this -> consignee_name;

        $data['address'] = $this -> address;

        $data['phone'] = $this -> consignee_phone;

        $data['member_id'] = $this->member_id;

        $data['city'] = $this -> city;

        $data['county'] = $this -> county;

        $data['province'] = $this -> province;

        $domain = new Domain_MyAddresss();

        $res = $domain->updateMyAddresss($data);

        if($res){

            $rs['code'] = 1;

        }

        return $rs;



    }

    /**
     * 将用户的地址信息插入到订单里
     */
    public function inAddress(){

        $rs = array('code' => 0, 'msg' => '', 'info' => array());



        $domain = new Domain_MyAddresss();

        $res = $domain->inAddress($this->openid);

        if($res){

            $rs['code'] = 1;

        }

        return $rs;



    }










}