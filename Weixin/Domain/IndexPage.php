<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/12/12
 * Time: 14:02
 */
class Domain_IndexPage{
    public function getBanner(){
        $model=new Model_IndexPage();
        $rel=$model->getBanner();
        return $rel;
    }

    public function search($data){

        try{

            $model=new Model_IndexPage();

            $res=$model->search($data->name);

            return $res;

        }catch (Exception $e){

            DI()->logger->error('首页检索失败','商品名:'.$data->name.'异常信息:'.$e);

            return false;
        }
    }
}