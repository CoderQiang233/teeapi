<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/5/17 0017
 * Time: 11:07
 */
class Domain_MeetingRoom{
    public function getList(){
        $model=new Model_MeetingRoom();
        $rel=$model->getList();
        return $rel;
    }

    public function add($data){
        $model=new Model_MeetingRoom();
        $rel=$model->add($data);
        return $rel;
    }

    public function edit($data){
        $model=new Model_MeetingRoom();
        $rel=$model->edit($data);
        return $rel;
    }

    public function del($data){
        $model = new Model_MeetingRoom();
        $rel = $model->del($data);
        return $rel;
    }

    public function getMeetingRoomList(){
        $model=new Model_MeetingRoom();
        $rel=$model->getMeetingRoomList();
        return $rel;
    }
}