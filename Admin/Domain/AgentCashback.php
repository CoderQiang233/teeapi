<?php
/**
 * Created by PhpStorm.
 * User: ${zhouyuan}
 * Date: 2018/10/19
 * Time: 15:36
 */


class Domain_AgentCashback
{

    public function getList($data){
        try{

            $model=new Model_AgentCashback();

            $res=$model->getList($data);

            return $res;

        }catch (Exception $e){

            DI()->logger->error('查看推客列表信息失败','异常信息:'.$e);

            return false;
        }
    }



}