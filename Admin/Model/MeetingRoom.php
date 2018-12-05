<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/5/17 0017
 * Time: 11:08
 */

class Model_MeetingRoom extends PhalApi_Model_NotORM{

    protected function getTableName($id) {
        return 'meetingroom';
    }

    public function getList(){
        $data=$this->getORM()->select('*');
        return $data;

    }

    public function add($data){
        $arr = array(
            'roomName' => $data->roomName,
            'numbers' => $data->numbers,
        );
        $rs = $this->getORM()->insert($arr);
        $list = $this->getORM()->fetchAll();
        if (!$rs){
            return Common_GetReturn::getReturn(false,'添加失败',$list);
        }
        return Common_GetReturn::getReturn(true,'添加成功',$list);
    }


    public function edit($data){
        $arr = array(
            'roomName' => $data->roomName,
            'numbers' => $data->numbers,
        );
        $rs = $this->getORM()->where('id',$data->id)->update($arr);
        $list = $this->getORM()->fetchAll();
        if ($rs >= 1) {
            //成功
            return Common_GetReturn::getReturn(true,'修改成功',$list);
        } else if ($rs === 0) {
            //相同数据，无更新
            return Common_GetReturn::getReturn(false,'相同数据无更新',$list);
        } else if ($rs === false) {
            //更新失败
            return Common_GetReturn::getReturn(false,'修改失败',$list);
        }
    }


    public function del($id){
        $rs = $this->getORM()->where('id', $id)->delete();
        $list = $this->getORM()->fetchAll();
        if (!$rs) {
            return Common_GetReturn::getReturn(false, '删除失败', $list);
        }
        return Common_GetReturn::getReturn(true, '删除成功', $list);
    }


    public function getMeetingRoomList(){
        $data=DI()->notorm->meetingroom->select('*')->fetchAll();
        return $data;
    }


}