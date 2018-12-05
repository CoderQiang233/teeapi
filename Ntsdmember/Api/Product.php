<?php

/**
 * 商品API
 *
 * @author: dogstar <chanzonghuang@gmail.com> 2014-10-04
 */
class Api_Product  extends PhalApi_Api{


    public function getRules() {
        return array(
            'getById' => array(
                'id' 	=> array('name' => 'id', 'type' =>'string', 'require' => true)
            ),
            'getByOpenId' => array(
                'session3rd'   => array('name' => 'session3rd', 'require' => true,'type'=>'string' ,'source' => 'post'),
            ),
            'getMemberOrder' => array(
                'id'   => array('name' => 'id', 'require' => true,'type'=>'string'),
            ),
        );
    }


    /**
     * 商品信息列表
     * @desc  获取商品列表
     */
    public function getlist(){

            $member = new Domain_Product();

            $result = $member->getlist();

            return $result;

    }

    /**
     * 单个商品信息
     */
    public function getById(){

        $rs = array('code' => 0, 'msg' => '', 'info' => array());

        $id = $this ->id;

        $domain = new Domain_Product();

        $result = $domain->getById($id);

        $rs['code'] = 1;

        $rs['info'] = $result;

        return $rs;


    }

    /**
     * 通过openId获取用户信息
     */
    public function getByOpenId(){

        $rs = array('code' => 0, 'msg' => '', 'info' => array());

        $domain = new Domain_Product();

        $session = DI()->wechatMini->getSession($this->session3rd);

        DI()->logger->debug("session: ",array("session3rd"=>$session));

        $openId=$session['openid'];

        $result = $domain->getByOpenId($openId);

//        if($result){
//            $rs['msg']= "YES";
//        }else{
//            $rs['msg']= "NO";
//        }
        $rs['code'] = 1;

        $rs['info'] = $result;

        return $rs;
    }


    /**
     * 获取用户订单详情
     */
    public function getMemberOrder(){

        $rs = array('code' => 0, 'msg' => '', 'info' => array());

        $domain = new Domain_Product();

        $result = $domain->getMemberOrder($this->id);

        $rs['code'] = 1;

        $rs['info'] = $result;

        return $rs;
    }


}