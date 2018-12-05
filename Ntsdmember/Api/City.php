<?php
/**
 * 省市区详细数据管理
 * Created by PhpStorm.
 * User: ${zhouyuan}
 * Date: 2018/10/23
 * Time: 15:18
 */
class Api_City extends PhalApi_Api{
    public function getRules() {
        return array(
            'getCityList' => array(
            ),

        );
    }
    /**
     * 获取城市信息列表
     * @desc 获取城市信息列表
     * @return int code 操作码，1表示成功， 0表示失败 2 表示验证失败
     * @return string msg 提示信息
     */

    public function getCityList(){
        $rs = array('code' => 1, 'msg' => '','list'=>[]);

        $domain = new Domain_City();
        $rel=$domain->getCityList($this);


        $rs['list']=$rel;

        return $rs;

    }


}