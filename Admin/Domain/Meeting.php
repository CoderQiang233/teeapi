<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/5/17 0017
 * Time: 11:07
 */
class Domain_Meeting{
    public function getListByCond($current,$meetingRoom,$meetingName,$searchDate,$mStatus){
        $model=new Model_Meeting();
        $rel=$model->getListByCond($current,$meetingRoom,$meetingName,$searchDate,$mStatus);
        return $rel;
    }

    public function add($data){
        $model=new Model_Meeting();
        $rel=$model->add($data);
        return $rel;
    }

    public function edit($data){
        $model=new Model_Meeting();
        $rel=$model->edit($data);
        return $rel;
    }

    public function del($data){
        $model=new Model_Meeting();
        $rel=$model->del($data);
        return $rel;
    }

    public function getRoomInfoList($meetingroom,$nowtime){
        $model=new Model_Meeting();
        $rel=$model->getRoomInfoList($meetingroom,$nowtime);
        return $rel;
    }

    public function getMeetingDetail($meetingID){
        $model=new Model_Meeting();
        $rel=$model->getMeetingDetail($meetingID);
        return $rel;
    }


    public function startMeeting($id){
        $model=new Model_Meeting();
        $rel=$model->startMeeting($id);
        return $rel;
    }

    public function endMeeting($id){
        $model=new Model_Meeting();
        $rel=$model->endMeeting($id);
        return $rel;
    }

    public function getSignInStaff($id){
        $model=new Model_Meeting();
        $rel=$model->getSignInStaff($id);
        return $rel;
    }
}