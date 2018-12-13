<?php
/**
 * 小程序首页接口

 */
class Api_IndexPage extends PhalApi_Api {
    public function getRules() {

        return array(

            'search'=>array(
                'name' 	=> array('name' => 'name', 'type' =>'string', 'require' => true,'desc'=>'商品名称'),
            )

        );

    }


    /**
     * 获取banner列表
     */
    public function getBanner(){
        $rs = array('code' => 0, 'msg' => '', 'list' => array());
        $domain=new Domain_IndexPage();
        $rel=$domain->getBanner();
        $rs['list']=$rel;
        return $rs;
    }
    /**
     * 获取首页模块
     */
    public function getModules(){
        $rs = array('code' => 0, 'msg' => '', 'list' => array());
        
    }

    /**
     * 首页检索
     */
    public function search(){

        $rs = array('code' => 0, 'msg' => '', 'info' => array());

        $domain = new Domain_IndexPage();

        $result = $domain -> search($this);

        if(is_array($result)){

            $rs['code'] = 1;

            $rs['info'] = $result;

        }

        return $rs;

    }
}