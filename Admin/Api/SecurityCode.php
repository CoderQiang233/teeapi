<?php
/**
 * 防伪码信息管理
 * Created by PhpStorm.
 * User: ${zhouyuan}
 * Date: 2018/9/28
 * Time: 10:43
 */
class Api_SecurityCode extends PhalApi_Api {
    public function getRules() {
        return array(
            'getSecurityCodeList' => array(
            ),
            'generateSecurityCode' => array(
                'num' => array('name' => 'num', 'type' => 'int', 'require' => true, 'desc' => '要生成的防伪码数量'),
            ),
        );
    }

    /**
     * 获取当日防伪码信息列表
     * @desc 获取当日防伪码信息列表
     * @return int code 操作码，1表示成功， 0表示失败 2 表示验证失败
     * @return string msg 提示信息
     */

    public function getSecurityCodeList(){
        $rs = array('code' => 1, 'msg' => '');

        $domain = new Domain_SecurityCode();
        $rel=$domain->getSecurityCodeList($this);


        $rs['list']=$rel;


        return $rs;

    }

 /**
  * 生成防伪码
  */
  public function  generateSecurityCode(){
      $rs = array('code' => 1, 'msg' => '',);
      $domain = new Domain_SecurityCode();
      $rel=$domain->generateSecurityCode($this);

      if($rel){

          $rs['code'] = 1;
          $rs['msg'] = 'success';
      }
      return $rs;
  }


}