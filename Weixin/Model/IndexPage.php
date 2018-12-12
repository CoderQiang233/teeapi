<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/12/12
 * Time: 14:02
 */
class Model_IndexPage extends PhalApi_Model_NotORM{
    public function getBanner(){
        $data=DI()->notorm->banner->select('*')->order('id DESC')->fetchAll();
        return $data;
    }
}