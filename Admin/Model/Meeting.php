<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/5/17 0017
 * Time: 11:08
 */

class Model_Meeting extends PhalApi_Model_NotORM{

    protected function getTableName($id) {
        switch ($id){
            case 1:
                return 'meeting_info';
            case 2:
                return 'meetinginfo';
        }
    }

    public function getListByCond($current,$meetingRoom,$meetingName,$searchDate,$mStatus){
        $pageSize=DI()->config->get('app.pageSizeAdmin');
        $meetingORM=$this->getORM(1)->select('*');
        if ('undefined' !== $meetingRoom && '' !== $meetingRoom && null !== $meetingRoom ){
            $meetingORM=$meetingORM->where('meetingRoom',$meetingRoom);
        };
        if ('undefined' !== $meetingName && '' !== $meetingName && null !== $meetingName ){
            $meetingORM=$meetingORM->where('meetingName LIKE ?','%'.$meetingName.'%');
        };
        if ('undefined' !== $searchDate && '' !== $searchDate && null !== $searchDate) {
            $meetingORM = $meetingORM->where('beginTime < ?', $searchDate)->where('endTime > ?',$searchDate);
        };
        if ($mStatus=='1'){
            $meetingORM=$meetingORM->or('status','0')->or('status','1');
        }
        if ($mStatus=='2'){
            $meetingORM=$meetingORM->where('status','2');
        }
        $total=$meetingORM->count();
        $data=$meetingORM->order('time DESC')->limit(($current-1)*$pageSize,$pageSize)->fetchAll();
        $rs['list'] = $data;
        $rs['total']=(int)$total;
        $rs['pageSize']=$pageSize;
        $rs['current']=$current;
        return $rs;

    }

    public function add($data){
        $arr = array(
            'meetingName' => $data->meetingName,
            'lecturer' => $data->lecturer,
            'introduction' => $data->introduction,
            'time' => $data->time,
            'meetingRoom' => $data->meetingRoom,
            'inchargeDept' => $data->inchargeDept,
            'organizer' => $data->organizer,
            'content' => $data->content,
            'members' => $data->members,
            'protocol' => $data->protocol,
            'test' => $data->test,
            'beginTime' => $data->beginTime,
            'endTime' => $data->endTime,
            'hasPhoto' => $data->hasPhoto,

        );
        $rs = $this->getORM(2)->insert($arr);
        if (!$rs){
            return Common_GetReturn::getReturn(false,'添加失败',[]);
        }
        return Common_GetReturn::getReturn(true,'添加成功',[]);
    }


    public function edit($data){
        $arr = array(
            'meetingName' => $data->meetingName,
            'lecturer' => $data->lecturer,
            'introduction' => $data->introduction,
            'time' => $data->time,
            'meetingRoom' => $data->meetingRoom,
            'inchargeDept' => $data->inchargeDept,
            'organizer' => $data->organizer,
            'content' => $data->content,
            'members' => $data->members,
            'protocol' => $data->protocol,
            'test' => $data->test,
            'beginTime' => $data->beginTime,
            'endTime' => $data->endTime,
            'hasPhoto' => $data->hasPhoto,

        );
        $rs = $this->getORM(2)->where('id',$data->id)->update($arr);
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
        $rs = $this->getORM(2)->where('id',$id)->delete();
        if (!$rs){
            return Common_GetReturn::getReturn(false,'删除失败',[]);
        }
        return Common_GetReturn::getReturn(true,'删除成功',[]);
    }

    public function getRoomInfoList($meetingroom,$nowtime){
        $data=DI()->notorm->meeting_info->select('*')->where('meetingRoom',$meetingroom)->where('beginTime <=?',$nowtime)->where('endTime >=?',$nowtime)->fetchAll();
        return $data;
    }

    public function getMeetingDetail($meetingID){
        $data=DI()->notorm->meeting_info->select('*')->where('id',$meetingID)->fetchOne();
        return $data;
    }

    public function startMeeting($id){
        $arr = array(
            'status'  => 1,
        );
        $rs   = DI()->notorm->meeting_info->where('id', $id)->update($arr);
        if($rs === false){
            $rel=Common_GetReturn::getReturn(false,'修改数据失败',[]);
            return $rel;
        }
        $rel=Common_GetReturn::getReturn(true,'修改成功',[]);
        return $rel;
    }
    public function endMeeting($id){
        $arr = array(
            'status'  => 2,
        );
        $rs   = DI()->notorm->meeting_info->where('id', $id)->update($arr);
        if($rs === false){
            $rel=Common_GetReturn::getReturn(false,'修改数据失败',[]);
            return $rel;
        }
        $rel=Common_GetReturn::getReturn(true,'修改成功',[]);
        return $rel;
    }

    public function getSignInStaff($id){
//        $rs   = DI()->notorm->meeting_info->where('id', $id)->update($arr);


        $sql = 'SELECT s.*,f.name,f.jobNum,d.deptName '
            . 'FROM hy_signin s  LEFT JOIN hy_staff f '
            . ' ON s.staffId=f.id LEFT JOIN hy_department d ON f.department=d.id'
            .' WHERE  s.meetingId='. $id
            .' ORDER BY s.signTime DESC';

        $rows = $this->getORM()->queryAll($sql);
        return $rows;
    }
}