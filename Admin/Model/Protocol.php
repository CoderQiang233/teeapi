<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/5/17 0017
 * Time: 11:08
 */

class Model_Protocol extends PhalApi_Model_NotORM{

    protected function getTableName($id) {
        switch ($id){
            case 1:
                return 'protocol';
            case 2:
                return 'meetinginfo';
        }
    }

    public function getListByCond(){
        $data=$this->getORM(1)->select('*')->fetchAll();
        $rs['list'] = $data;
        return $rs;

    }

    public function add($data){
        $arr = array(
            'name' => $data->name,
            'content' => $data->content,
            'submitTime' => date("Y-m-d H:i:s")
        );
        $rs = $this->getORM(1)->insert($arr);
        if (!$rs){
            return Common_GetReturn::getReturn(false,'添加失败',[]);
        };
        $data=$this->getORM(1)->select('*')->fetchAll();
        return Common_GetReturn::getReturn(true,'添加成功',$data);
    }


    public function edit($data){
        $arr = array(
            'name' => $data->name,
            'content' => $data->content,
        );
        $rs = $this->getORM(1)->where('id',$data->id)->update($arr);
        if ($rs >= 1) {
            //成功
            return Common_GetReturn::getReturn(true,'修改成功',[]);
        } else if ($rs === 0) {
            //相同数据，无更新
            return Common_GetReturn::getReturn(false,'相同数据无更新',[]);
        } else if ($rs === false) {
            //更新失败
            return Common_GetReturn::getReturn(false,'修改失败',[]);
        }
    }


    public function del($id){
        $rs = $this->getORM(1)->where('id',$id)->delete();
        if (!$rs){
            return Common_GetReturn::getReturn(false,'删除失败',[]);
        }
        $data=$this->getORM(1)->select('*')->fetchAll();
        return Common_GetReturn::getReturn(true,'删除成功',$data);
    }
}