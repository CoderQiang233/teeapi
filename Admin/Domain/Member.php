<?php
/**
 * Created by PhpStorm.
 * User: ${zhouyuan}
 * Date: 2018/9/26
 * Time: 14:34
 */
class Domain_Member {

    public function getList($data){
        try{

            $model=new Model_Member();

            $res=$model->getList($data);

            return $res;

        }catch (Exception $e){

            DI()->logger->error('查看会员列表信息失败','异常信息:'.$e);

            return false;
        }
    }

}