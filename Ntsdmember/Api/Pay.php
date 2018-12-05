<?php
/**
 * 支付API
 *
 * @author: dogstar <chanzonghuang@gmail.com> 2014-10-04
 */
class Api_Pay extends PhalApi_Api {

	public function getRules() {
        return array(
            'index' => array(
                'type' 	=> array('name' => 'type', 'type' =>'enum', 'require' => true, 'range' => array('aliwap', 'wechat'), 'desc' => '引擎类型，比如aliwap')
            ),
            'addOrder' => array(
                'name' => array('name' => 'name', 'require' => true,'type' => 'string','source' => 'post'),
                'wx_num' => array('name' => 'wx_num', 'require' => true,'type' => 'string','source' => 'post'),
                'phone' => array('name' => 'phone','require' => true,'type'=>'string','source' => 'post'),
                'level'=>array('name' => 'level','require' => true,'type'=>'string','source' => 'post'),
                'level_info'=>array('name' => 'level_info','require' => true,'type'=>'string','source' => 'post'),
                'level_price'=>array('name' => 'level_price','require' => true,'type'=>'string','source' => 'post'),
                'session3rd'   => array('name' => 'session3rd', 'require' => true,'type'=>'string' ,'source' => 'post'),
                'nick_name' => array('name' => 'nick_name', 'require' => true,'type'=>'string' ,'source' => 'post'),
                'head_portrait' => array('name' => 'head_portrait', 'require' => true,'type'=>'string','source' => 'post' ),
                'referee_phone' => array('name' => 'referee_phone', 'require' => false,'type'=>'string','source' => 'post' ),
                'idcard' => array('name' => 'idcard', 'require' => true,'type'=>'string','source' => 'post' ),
                'vcode' => array('name' => 'vcode', 'type'=>'string','source' => 'post' ),
                'money' => array('name' => 'money', 'require' => true,'source' => 'post','desc'=>'实际支付金额' ),
                'member_order_id' => array('name' => 'member_order_id','source' => 'post','desc'=>'会员订单id' ),
            ),
          'upgrade' => array(
                'members_id' => array('name' => 'members_id', 'require' => true,'type' => 'string','source' => 'post'),
                'before_level' => array('name' => 'before_level','require' => true,'type'=>'string','source' => 'post'),
                'up_level'=>array('name' => 'up_level','require' => true,'type'=>'string','source' => 'post'),
                'up_level_info'=>array('name' => 'up_level_info','require' => true,'type'=>'string','source' => 'post'),
                'up_price'=>array('name' => 'up_price','require' => true,'type'=>'string','source' => 'post'),
                'openid'   => array('name' => 'openid', 'require' => true,'type'=>'string' ,'source' => 'post'),
            ),
            'proxybinding' => array(
                'wx_num' => array('name' => 'wx_num', 'require' => true,'type' => 'string','source' => 'post'),
                'phone' => array('name' => 'phone','require' => true,'type'=>'string','source' => 'post'),
                'session3rd'   => array('name' => 'session3rd', 'require' => true,'type'=>'string' ,'source' => 'post'),
                'nick_name' => array('name' => 'nick_name', 'require' => true,'type'=>'string' ,'source' => 'post'),
                'head_portrait' => array('name' => 'head_portrait', 'require' => true,'type'=>'string','source' => 'post' ),
                'vcode' => array('name' => 'vcode', 'require' => true,'type'=>'string','source' => 'post' ),
            ),

            'findMemOrderBySession3rd' => array(
                'session3rd'   => array('name' => 'session3rd', 'require' => true,'type'=>'string' ,'source' => 'post','desc'=>'session3rd'),
            ),

            'findRecordById' => array(
                'member_order_id'   => array('name' => 'member_order_id', 'require' => true,'type'=>'string' ,'source' => 'post','desc'=>'会员订单id'),
            ),
            'checkCode' => array(
                'phone' => array('name' => 'phone','require' => true,'type'=>'string','source' => 'post'),
                'vcode' => array('name' => 'vcode', 'require' => true,'type'=>'string','source' => 'post' ),
            ),
        );
	}

    /**
     * @return int
     * 验证短信验证码
     */
    public function checkCode(){
        $rs = array('code' => 0, 'msg' => '', 'info' => array());
         $cache = DI()->cache->get($this->phone);
         if ($cache == null||$cache != $this->vcode){
              $rs['msg'] ='验证码错误';
             return $rs;
         }
        return 1;
    }



    /**
     * 通过member_order_id获取订单记录
     */
    public function findRecordById(){

        $rs = array('code' => 0, 'msg' => '', 'info' => array());

        $domain = new Domain_Pay();

        $result = $domain->findRecordById($this->member_order_id);

        if($result){

            $rs['code'] = 1;

            $rs['info'] = $result;
        }

        return $rs;
    }

    /**
     * 通过session3rd获取会员订单信息
     */
    public function findMemOrderBySession3rd(){

        $rs = array('code' => 0, 'msg' => '', 'info' => array());

        $session = DI()->wechatMini->getSession($this->session3rd);

        $openid = $session['openid'];

        $domain = new Domain_Pay();

        $result = $domain->findMemOrderBySession3rd($openid);

        if($result){

            $rs['code'] = 1;

            $rs['info'] = $result;
        }

        return $rs;
    }


	public function addOrder(){

        $rs = array('code' => 0, 'msg' => '', 'info' => array());

       //  获取
        //$cache = DI()->cache->get($this->phone);
       // if ($cache == null||$cache != $this->vcode){
       //     $rs['msg'] ='验证码错误';
        //    return $rs;
       // }

       // 获取对应的支付引擎
        DI()->pay->set('wechat');

        $session = DI()->wechatMini->getSession($this->session3rd);

        DI()->logger->debug("session: ",array("session3rd"=>$session));

        $data = array();

        $data['order_id'] = DI()->pay->createOrderNo();

        $data['name'] = $this -> name;

        $data['wx_num'] = $this -> wx_num;

        $data['phone'] = $this -> phone;

        $data['openid'] = $session['openid'];

        $data['level'] = $this -> level;

      	$data['referee_phone'] = $this -> referee_phone;

      	$data['idcard'] = $this -> idcard;

        $data['level_info'] = $this -> level_info;

        $data['level_price'] = $this -> level_price;

        $data['nick_name'] = $this-> nick_name;

        $data['head_portrait'] = $this -> head_portrait;

		$data['create_time'] = date('Y-m-d H:i:s',time());

        $domain = new Domain_Pay();

        $result = $domain->addOrder($data,$this);

        if($result){

            $rs['code'] = 1;
            $rs['msg'] ='会员订单成功并且获取统一订单成功';
            $rs['info'] = $result;
        }else{

            $rs['msg'] ='生成会员订单失败';
        }

        return $rs;

    }
  
  	/**
     * 会员升级接口
     */
	public function upgrade(){

        $rs = array('code' => 0, 'msg' => '', 'info' => array());

        //获取对应的支付引擎
        DI()->pay->set('wechat');

        $data = array();

        $data['openid'] = $this-> openid;

        $data['order_id'] = DI()->pay->createOrderNo();

        $data['members_id'] = $this -> members_id;

        $data['before_level'] = $this -> before_level;

        $data['up_level'] = $this -> up_level;
      
      	$data['up_price'] = $this -> up_price;

        $data['up_level_info'] = $this -> up_level_info;

		$data['create_time'] = date('Y-m-d H:i:s',time());

		$data['pay'] =0;


        $domain = new Domain_Pay();

        $result = $domain->upgrade($data);

        if($result){

            $rs['code'] = 1;
            $rs['msg'] ='会员订单成功并且获取统一订单成功';
            $rs['info'] = $result;
        }else{

            $rs['msg'] ='生成会员订单失败';
        }

        return $rs;

    }


    /**
     * 代理绑定接口
     */
    public function proxybinding(){

        $rs = array('code' => 0, 'msg' => '', 'info' => array());

//         获取
//        $cache = DI()->cache->get($this->phone);
//        if ($cache == null||$cache != $this->vcode){
//            $rs['msg'] ='验证码错误';
//            return $rs;
//        }


        $data = array();

        $session = DI()->wechatMini->getSession($this->session3rd);

        DI()->logger->debug("session: ",array("session3rd"=>$session));

        $data['openid'] = $session['openid'];

        $data['wx_num'] = $this -> wx_num;

        $data['phone'] = $this -> phone;

        $data['nick_name'] = $this -> nick_name;

        $data['head_portrait'] = $this -> head_portrait;


        $domain = new Domain_Pay();

        $result = $domain->proxybinding($data);


        if($result=='没有该会员'){
            $rs['code'] = 2;
            $rs['msg'] ='没有该会员';
        }
        if($result>=1){
            $rs['code'] = 1;
            $rs['msg'] ='绑定成功';
            $rs['info'] = $result;
        }
        if($result =='重复绑定') {
            $rs['code'] = 0;
            $rs['msg'] ='重复绑定';
        }

        return $rs;

    }




}