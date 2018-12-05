<?php
/**
 * 测试发短信
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/7/31 0031
 * Time: 13:34
 */

class Api_Sms extends PhalApi_Api {

    public function getRules() {
        return array(
            'sendSms'=>array(
                'phone' => array('name' => 'phone', 'type' =>'string','require' => true)
            )
        );
    }

    /**
     * 发送短信
     */
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
            DI()->cache->set($this->phone, $str, 120);
        }
        return $response;
    }

}