<?php
/**
 * 推广中心接口

 */
class Api_PromotionCenter extends PhalApi_Api {
    public function getRules() {

        return array(

            'getInfo'=>array(
                'session' 	=> array('name' => 'session', 'type' =>'string', 'require' => true),
            ),
            'getOrder'=>array(
                'session' 	=> array('name' => 'session', 'type' =>'string', 'require' => true),
            )

        );

    }


    /**
     * 通过session获取用户余额等信息
     */
    public function getInfo(){
        $rs = array('code' => 0, 'msg' => '', 'info' => '');

        $domain = new Domain_PromotionCenter();

        $session = DI()->wechatMini->getSession($this->session);

        $this->openid=$session['openid'];

        $rel=$domain->getInfo($this);

        if($rel){
            $rs['code']=1;
            $rs['info']=$rel;
        }
        return $rs;
    }


    /**
     * 通过session获取用户推广订单
     */
    public function getOrder(){
        $rs = array('code' => 0, 'msg' => '', 'info' => '');

        $domain = new Domain_PromotionCenter();

        $session = DI()->wechatMini->getSession($this->session);

        $this->openid=$session['openid'];

        $rel=$domain->getOrder($this);

        if($rel){
            $rs['code']=1;
            $rs['info']=$rel;
        }
        return $rs;
    }




}