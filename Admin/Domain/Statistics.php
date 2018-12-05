<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/5/25
 * Time: 16:09
 */
class Domain_Statistics{
    public function getStatisticsList($data){
        $model=new Model_Statistics();
        $rel=$model->getStatisticsList($data);
        return $rel;
    }




    public function getSignInList($meetingId,$signInType){
        $model=new Model_Statistics();
        $rel=$model->getSignInList($meetingId,$signInType);
        return $rel;
    }


    public function exportSignInList($meetingId,$signInType){
        $model=new Model_Statistics();
        $rel=$model->exportSignInList($meetingId,$signInType);
        return $rel;
    }
}