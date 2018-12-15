<?php
/**
 * 个人中心相关接口

 */
class Api_PersonalCenter extends PhalApi_Api {
    public function getRules() {

        return array(

            'search'=>array(
                'name' 	=> array('name' => 'name', 'type' =>'string', 'require' => true,'desc'=>'商品名称'),
            )

        );

    }



    public function getMemerInfo(){

    }
}