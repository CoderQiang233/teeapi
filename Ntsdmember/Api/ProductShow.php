<?php
/**
 * 商品展示页面接口
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/10/11 0011
 * Time: 上午 9:51
 */

class Api_ProductShow extends PhalApi_Api
{
    public function getRules()
    {
        return array(
            'getProDuctList' => array(
//                'order_id' => array('name' => 'order_id', 'type' => 'string', 'require' => true),
            ),
        );
    }

    public function getProDuctList (){

        $rs =array('code' =>0, 'msg'=>'', 'info'=>array());

        $domain =new Domain_ProductShow();

        $info =$domain->getProductLists();


        if (empty($info)){
            $rs ['code'] =1;
            $rs ['msg'] =T('信息为空');

            return $rs;
        }
            $rs ['info'] =$info;

            return $rs;

        }
}