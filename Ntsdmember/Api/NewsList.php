<?php
/**
 * 新闻中心接口
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/10/19 0019
 * Time: 上午 11:08
 */

class Api_NewsList extends PhalApi_Api{
    public function getRules()
    {
        return array(
            'getNewsList'=>array(),
            'getconpany'=>array(),

            'getNewsListByID' => array(
                'id'=> array('name' => 'id', 'type' =>'string', 'require' => true)),


        );
    }




    public function getNewsList(){
    $rs =array('code'=>0, 'msg'=>'','info'=>array());
    $domain = new  Domain_NewsList();
    $info =$domain->getNewsLists();
    if (empty($info)){
        $rs ['code'] =1;
        $rs ['msg'] =T('信息为空');
        return $rs;
    }
    $rs ['info'] =$info;
    return $rs;
}



    public function getconpany(){
        $rs =array('code'=>0, 'msg'=>'','info'=>array());
        $domain = new  Domain_NewsList();
        $info =$domain->getconpany();
        if (empty($info)){
            $rs ['code'] =1;
            $rs ['msg'] =T('信息为空');
            return $rs;
        }
        $rs ['info'] =$info;
        return $rs;
    }



    public function getNewsListByID(){
        $id = $this -> id;

        $rs = array('code' => 0, 'msg' => '', 'info' => array());

        $domain = new Domain_NewsList();

        $result = $domain -> getNewsListByID($id);

        if($result){

            $rs['code'] = 1;

            $rs['info'] = $result;

        }

        return $rs;
    }
}