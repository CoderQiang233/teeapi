<?php
/**
 * 后台登录相关
 *
 * @author: dogstar <chanzonghuang@gmail.com> 2014-10-04
 */

class Api_Login extends PhalApi_Api {

	public function getRules() {
        return array(
            'login' => array(
                'username' 	=> array('name' => 'username',  'type' => 'string', 'require' => true, 'desc' => '用户名' ),
                'password' 	=> array('name' => 'password',  'type' => 'string', 'require' => true, 'desc' => '密码' ),
                'type' 	=> array('name' => 'type',  'type' => 'string', 'require' => true, 'desc' => '用户类型' ),
            ),
            'checkToken' => array(
                'token' 	=> array('name' => 'token',  'type' => 'string', 'require' => true, 'desc' => '用户名' ),
            ),

        );
	}

    /**
     * 后台登录
     * @desc 用于获取单个用户基本信息
     * @return int code 操作码，1表示成功， 0表示失败
     * @return string msg 提示信息
     */
	public function login() {
        $rs = array('code' => 1, 'msg' => '', 'data' => array());
        $domain=new Domain_Login();
        $data=$domain->Login($this->username,$this->password);
        if(!$data){
            $rs['data']=array(
                'type'=>$this->type,
                'status'=>'error'
            );
        }else{
//            $jwtToken = Common_GetReturn::getToken($data);
            $rs['data']=array(
                'type'=>$this->type,
                'status'=>'ok',
                'role'=>$data['role'],
                'userName'=>$data['userName'],
                'userId'=>$data['id'],
                'name'=>$data['name'],

//                'jwtToken'=>$jwtToken,
            );
        }

        return $rs;
	}



}
