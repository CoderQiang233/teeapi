<?php
/**
 * 用户相关接口
 * User: Administrator
 * Date: 2018/12/20
 * Time: 13:59
 */

class Api_Member extends PhalApi_Api{
    public function getRules(){
        return array(
            'getMemberBalance' => array(
                'session3rd' => array('name'=>'session3rd','type' =>'string','require' => true,'source' => 'post','desc'=>'会员session'),
            ),
            'joinPromotion' => array(
                'session3rd' => array('name'=>'session3rd','type' =>'string','require' => true,'source' => 'post','desc'=>'会员session'),
            ),
        );
    }

    /**
     * 获取用户余额信息
     */
    public function getMemberBalance(){
        $rs = array('code' => 0, 'msg' => '', 'info' =>'');
        $session = DI()->wechatMini->getSession($this->session3rd);
        $openid=$session['openid'];
        $domain = new Domain_Member();
        $rel=$domain->getMemberBalance($openid);
        if ($rel){
            $rs['code']=1;
            $rs['info']=$rel['balance'];
            return $rs;
        }
        return $rs;
    }

    /**
     * 加入推客
     */
    public function joinPromotion(){
        $rs = array('code' => 0, 'msg' => '', 'info' =>'');
        $session = DI()->wechatMini->getSession($this->session3rd);
        $openid=$session['openid'];
        $domain = new Domain_Member();
        $rel=$domain->joinPromotion($openid);
        if ($rel){
            $rs['code']=1;
            return $rs;
        }
        return $rs;
    }
}