<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/5/17 0017
 * Time: 11:07
 */
class Domain_Exampaper{
    public function getList($meetingId){
        $model=new Model_Exampaper();
        $rel=$model->getList($meetingId);
        return $rel;
    }

    public function add($data){
        $model=new Model_Exampaper();
        $rel=$model->add($data);
        return $rel;
    }

    public function edit($data){
        $model=new Model_Exampaper();
        $rel=$model->edit($data);
        return $rel;
    }

    public function del($id,$meetingId){
        $model = new Model_Exampaper();
        $rel = $model->del($id,$meetingId);
        return $rel;
    }

}