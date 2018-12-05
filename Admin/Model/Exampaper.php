<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/5/17 0017
 * Time: 11:08
 */

class Model_Exampaper extends PhalApi_Model_NotORM{

    protected function getTableName($id) {
        switch ($id){
            case 1:
                return 'question_meeting';
            case 2:
                return 'questionanswer';
            case 3:
                return 'question';
        }
    }

    public function getList($meetingId){
        $data=$this->getORM(1)->select('*')->where('meetingId',$meetingId)->fetchAll();
        foreach ($data as $key=>$value){
            $queanswer = $this->getORM(2)->where('questionId',$value['id'])->order('content')->fetchAll();
            foreach ($queanswer as $index=>$item){
                $data[$key]['options'][$index]=$item['content'];
            }
        }
        return $data;
    }

    public function add($data){
        $questionORM = $this->getORM(3);
        $queanswerORM = $this->getORM(2);
        $arr = array(
            'title' => $data->title,
            'score' => $data->score,
            'answer' => $data->answer,
            'meetingId' => $data->meetingId,
            'type' => $data->type,
        );
        $rs = $questionORM->insert($arr);
        $questionId = $questionORM->insert_id();
        $options=json_decode($data->options);
        foreach ($options as $item){
            $option=array(
              'content'=>$item,
              'questionId'=>$questionId
            );
            $rs = $queanswerORM->insert($option);
        }
        if (!$rs){
            return Common_GetReturn::getReturn(false,'添加失败',[]);
        }
        return Common_GetReturn::getReturn(true,'添加成功',[]);
    }


    public function edit($data){
        $questionORM = $this->getORM(3);
        $queanswerORM = $this->getORM(2);
        $arr = array(
            'title' => $data->title,
            'score' => $data->score,
            'answer' => $data->answer,
            'meetingId' => $data->meetingId,
            'id' => $data->id,
        );
        $rs = $questionORM->where('id',$data->id)->update($arr);
        $queanswerORM->where('questionId',$data->id)->delete();
        $options=json_decode($data->options);
        foreach ($options as $item){
            $option=array(
                'content'=>$item,
                'questionId'=>$data->id
            );
            $rs = $queanswerORM->insert($option);
        }
        if (!$rs){
            return Common_GetReturn::getReturn(false,'修改失败',[]);
        }
        return Common_GetReturn::getReturn(true,'修改成功',[]);

    }


    public function del($id,$meetingId){
        $rs = $this->getORM(3)->where('id', $id)->delete();
        $list=$this->getORM(1)->select('*')->where('meetingId',$meetingId)->fetchAll();
        foreach ($list as $key=>$value){
            $queanswer = $this->getORM(2)->where('questionId',$value['id'])->order('content')->fetchAll();
            foreach ($queanswer as $index=>$item){
                $list[$key]['options'][$index]=$item['content'];
            }
        }
        if (!$rs) {
            return Common_GetReturn::getReturn(false, '删除失败', $list);
        }
        return Common_GetReturn::getReturn(true, '删除成功', $list);
    }




}