<?php
/**
 * 登录
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/12/12 0012
 * Time: 上午 11:00
 */
class Api_login extends PhalApi_Api{

    public function getRules() {
        return array(
            //session查找用户信息
            'index' => array(
                'session3rd' 	=> array('name' => 'session3rd', 'type' =>'string', 'require' => true,'source' => 'post')
            ),
            //手机验证码接口
            'sendSms'=>array(
                'phone' => array('name' => 'phone', 'type' =>'string','require' => true)
            ),

        );
    }

//检查用户是否已注册

    public function index(){
        $rs = array('code' => 0, 'msg' => '', 'info' => array());
        $session = DI()->wechatMini->getSession($this->session3rd);
        if(isset($session['openid'])){
            $domain = new Domain_Login();
            $result = $domain ->index($session['openid']);
            if($result){
                $rs['code'] = 1;

                $rs['info'] = $result;
            }
        }
        return $rs;
    }


//手机验证码接口
    public function sendSms(){
        $sms = DI()->sms;
        // 生成6位纯数字字符串
        $str = PhalApi_Tool::createRandStr(6, "0123456789");
        $param = array(
            'code'=>$str
        );
        $response = $sms::sendSms($this->phone, 'SMS_145645944', $param);
        if ($response->Code && $response->Code == 'OK') {
            // 设置验证码缓存，有郊时间2分钟
            DI()->cache->set($this->phone, $str, 60);
        }
        return $response;
    }
}
