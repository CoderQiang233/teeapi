<?php
/**
 * 登录
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/12/12 0012
 * Time: 上午 11:00
 */
class Api_login extends PhalApi_Api
{

    public function getRules()
    {
        return array(
            //session查找用户信息
            'index' => array(
                'session3rd' => array('name' => 'session3rd', 'type' => 'string', 'require' => true, 'source' => 'post')
            ),
            //手机验证码接口
            'sendSms' => array(
                'phone' => array('name' => 'phone', 'type' => 'string', 'require' => true)
            ),
            //点击提交时验证所输入的验证码是否正确
            'checkCode' => array(
                'phone' => array('name' => 'phone', 'require' => true, 'type' => 'string', 'source' => 'post'),
                'vcode' => array('name' => 'vcode', 'require' => true, 'type' => 'string', 'source' => 'post'),
            ),
            'userRegister' => array(
                'nickName' => array('name' => 'nickName', 'require' => true, 'type' => 'string', 'source' => 'post'),
                'name' => array('name' => 'name', 'require' => true, 'type' => 'string', 'source' => 'post'),
                'phone' => array('name' => 'phone', 'require' => true, 'type' => 'string', 'source' => 'post'),
                'headPortrait' => array('name' => 'headPortrait', 'require' => true, 'type' => 'string', 'source' => 'post'),
                'session3rd' => array('name' => 'session3rd', 'require' => true, 'type' => 'string', 'source' => 'post'),
                'is_promoter' => array('name' => 'is_promoter', 'require' => true, 'type' => 'string', 'source' => 'post'),

                //          'creat_time'=>array('name'=>'creat_time','require' => false,'type'=>'string', 'source' => 'post')
                ),

            'insertInvoice' => array(
                'nickName' => array('name'=>'nickName','type' =>'string','require' => true,'source' => 'post'),
                'phone' => array('name'=>'phone','type' =>'string','require' => true,'source' => 'post'),
                'headPortrait' => array('name'=>'headPortrait','type' =>'string','require' => true,'source' => 'post'),
                'openid' =>array('name'=>'openid','type' =>'string','require' => true,'source' => 'post'),
              ),

        );
    }

//检查用户是否已注册

    public function index()
    {
        $rs = array('code' => 0, 'msg' => '', 'info' => array());
        $session = DI()->wechatMini->getSession($this->session3rd);
        if (isset($session['openid'])) {
            $domain = new Domain_Login();
            $result = $domain->index($session['openid']);
            if ($result) {
                $rs['code'] = 1;

                $rs['info'] = $result;
            }
        }
        return $rs;
    }


//手机验证码接口
    public function sendSms()
    {
        $sms = DI()->sms;
        // 生成6位纯数字字符串
        $str = PhalApi_Tool::createRandStr(6, "0123456789");
        $param = array(
            'code' => $str
        );
        $response = $sms::sendSms($this->phone, 'SMS_145645944', $param);
        if ($response->Code && $response->Code == 'OK') {
            // 设置验证码缓存，有郊时间2分钟
            DI()->cache->set($this->phone, $str, 600);
        }

        return $response;
    }

    /**
     * @return int
     * 验证短信验证码
     */
    public function checkCode()
    {
        $rs = array('code' => 0, 'msg' => '', 'info' => array());
        $cache = DI()->cache->get($this->phone);

        if ($cache == null || $cache != $this->vcode) {
            $rs['msg'] = '验证码错误';
            return $rs;
        }
        return 1;
    }

    /**
     * @return int
     * 用户注册
     */

    public function userRegister()
    {
        $rs = array('code' => 0, 'msg' => '', 'info' => array());


        $data = array();

        $data['nick_name'] = $this->nickName;
        $data['name'] =$this->nickName;

        $data['phone'] = $this->phone;

        $data['head_portrait'] = $this->headPortrait;
        $data['create_time']=date('Y-m-d H:i:s');

        $session = DI()->wechatMini->getSession($this->session3rd);
        $data['openid'] =$session['openid'];
        $data['balance'] =0.00;
        $data['is_promoter'] =$this->is_promoter;

        $domain = new Domain_Login();

        $res = $domain->userRegister($data);
        if($res ==0){
            $rs['msg']="用户存在";
            $rs['code'] = 2;
            return $rs;
        }

        if ($res) {

            $rs['code'] = 1;

        }

        return $rs;
    }






    public function insertInvoice(){


        $rs = array('code' => 0, 'msg' => '', 'info' => array());


        $data = array();

        $data['id'] = time();

        $data['nickName'] = $this -> nickName;

        $data['phone'] = $this -> phone;

        $data['headPortrait'] = $this -> headPortrait;

        $data['openid'] = $this -> openid;

        $domain = new Domain_Login();

        $res = $domain->insertInvoice($data);

        if($res){

            $rs['code'] = 1;

        }

        return $rs;



    }




}