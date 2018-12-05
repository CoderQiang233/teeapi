<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/5/25
 * Time: 16:09
 */
class Model_Statistics extends PhalApi_Model_NotORM{
    public function getStatisticsList($data){
        $departmentId=$data->departmentId;
        $dateTime=$data->dateTime;
//        $select=DI()->notorm->meetinginfo;
        $where='';
        if ('undefined' !== $departmentId && '' !== $departmentId && null !== $departmentId ){
//            $select=$select->where('department',$departmentId);
            $where=$where.' AND inchargeDept="'.$departmentId.'"';

        };
        if ('undefined' !== $dateTime && '' !== $dateTime && null !== $dateTime ){
//            $select=$select->where('beginTime<=',$dateTime)->where('endTime>=',$dateTime);
            $where=$where.' AND beginTime<="'.$dateTime.'" AND endTime>="'.$dateTime.'"';

        };
//        $meetingList=$select->where('status',2)->select('id','meetingName')->fetchAll();
        $sql = 'SELECT m.id,m.meetingName,m.hasPhoto,m.test,d.deptName '
            . 'FROM hy_meetinginfo m  LEFT JOIN hy_department d '
            . ' ON m.inchargeDept=d.id '
            .' WHERE m.status=2 '. $where
            .' ORDER BY m.id';

        $meetingList = $this->getORM()->queryAll($sql);

        foreach ($meetingList as $key=>$value){
            $rel=DI()->notorm->signin->where('meetingId',$value['id'])->count();
            $meetingList[$key]['signCount']=$rel;
        }

        return $meetingList;

    }




    public function getSignInList($meetingId,$signInType){
        if ($signInType=='0'){
            $rel=DI()->notorm->meetinginfo->select('members,hasPhoto,test')->where('id',$meetingId)->fetchOne();
            $meetingJoin=explode(',', $rel['members']);
            $list=[];
            foreach ($meetingJoin as $key=>$joinId){
                $staff=DI()->notorm->staff->select('*')->where('id',$joinId)->fetchOne();
                $dept=DI()->notorm->department->select('*')->where('id',$staff['department'])->fetchOne();
                $item=array(
                    'name'=>$staff['name'],
                    'jobNum'=>$staff['jobNum'],
                    'deptName'=>$dept['deptName']
                );
                $sign=DI()->notorm->signin->select('*')->where('meetingId',$meetingId)->where('staffId',$joinId)->fetchOne();
                if ($sign['staffId']){
                    $item['sign']=1;
                    $item['signTime']=$sign['signTime'];
                    $item['address']=$sign['address'];
                    $item['photopath']=$sign['photopath'];
                    $item['signOff']=$sign['signOff'];
                    $item['signOffTime']=$sign['signOffTime'];
                    $item['signOffAddress']=$sign['signOffAddress'];

                    if ($rel['test']==1){
                        $test=DI()->notorm->answer->select('*')->where('userId',$joinId)->where('meetingId',$meetingId)->fetchOne();
                        if ($test['id']){
                            $item['test']=$test['fraction'].'分';
                        }else{
                            $item['test']='未答题';
                        }
                    }
                }else{
                    $item['sign']=0;
                }
                $list[]=$item;
            }
            return $list;
        }
        elseif ($signInType=='1'){
//            已签到
            $rel=DI()->notorm->meetinginfo->select('members,hasPhoto,test')->where('id',$meetingId)->fetchOne();
            $meetingJoin=explode(',', $rel['members']);
            $list=[];
            foreach ($meetingJoin as $key=>$joinId){
                $staff=DI()->notorm->staff->select('*')->where('id',$joinId)->fetchOne();
                $dept=DI()->notorm->department->select('*')->where('id',$staff['department'])->fetchOne();

                $sign=DI()->notorm->signin->select('*')->where('meetingId',$meetingId)->where('staffId',$joinId)->fetchOne();
                if ($sign['staffId']){
                    $item=array(
                        'name'=>$staff['name'],
                        'jobNum'=>$staff['jobNum'],
                        'deptName'=>$dept['deptName']
                    );
                    $item['sign']=1;
                    $item['signTime']=$sign['signTime'];
                    $item['address']=$sign['address'];
                    $item['photopath']=$sign['photopath'];
                    $item['signOff']=$sign['signOff'];
                    $item['signOffTime']=$sign['signOffTime'];
                    $item['signOffAddress']=$sign['signOffAddress'];
                    if ($rel['test']==1){
                        $test=DI()->notorm->answer->select('*')->where('userId',$joinId)->where('meetingId',$meetingId)->fetchOne();
                        if ($test['id']){
                            $item['test']=$test['fraction'].'分';
                        }else{
                            $item['test']='未答题';
                        }
                    }
                    $list[]=$item;
                }

            }
            return $list;
        }
        elseif ($signInType=='2'){
//            未签到
            $rel=DI()->notorm->meetinginfo->select('members,hasPhoto,test')->where('id',$meetingId)->fetchOne();
            $meetingJoin=explode(',', $rel['members']);
            $list=[];
            foreach ($meetingJoin as $key=>$joinId){
                $staff=DI()->notorm->staff->select('*')->where('id',$joinId)->fetchOne();
                $dept=DI()->notorm->department->select('*')->where('id',$staff['department'])->fetchOne();

                $sign=DI()->notorm->signin->select('*')->where('meetingId',$meetingId)->where('staffId',$joinId)->fetchOne();
                if ($sign['staffId']){

                }else{
                    $item=array(
                        'name'=>$staff['name'],
                        'jobNum'=>$staff['jobNum'],
                        'deptName'=>$dept['deptName']
                    );
                    $item['sign']=0;
                    $list[]=$item;
                }

            }
            return $list;
        }

    }


    public function exportSignInList($meetingId,$signInType){
        if ($signInType==0){
            $rel=DI()->notorm->meetinginfo->select('members,hasPhoto,test')->where('id',$meetingId)->fetchOne();
            $meetingJoin=explode(',', $rel['members']);
            $list=[];
            foreach ($meetingJoin as $key=>$joinId){
                $staff=DI()->notorm->staff->select('*')->where('id',$joinId)->fetchOne();
                $dept=DI()->notorm->department->select('*')->where('id',$staff['department'])->fetchOne();
                $item=array(
                    'name'=>$staff['name'],
                    'jobNum'=>$staff['jobNum'],
                    'deptName'=>$dept['deptName']
                );
                $sign=DI()->notorm->signin->select('*')->where('meetingId',$meetingId)->where('staffId',$joinId)->fetchOne();
                if ($sign['staffId']){
                    $item['sign']='已签到';
                    $item['signTime']=$sign['signTime'];
                    $item['address']=$sign['address'];


//                $item['photopath']=$sign['photopath'];
                    if ($rel['test']==1){
                        $test=DI()->notorm->answer->select('*')->where('userId',$joinId)->where('meetingId',$meetingId)->fetchOne();
                        if ($test['id']){
                            $item['test']=$test['fraction'].'分';
                        }else{
                            $item['test']='未答题';
                        }
                    }
                    if ($sign['signOff']==1){
                        $item['signOff']='已签退';
                        $item['signOffTime']=$sign['signOffTime'];
                        $item['signOffAddress']=$sign['signOffAddress'];
                    }else{
                        $item['signOff']='未签退';
                        $item['signOffTime']=$sign['signOffTime'];
                        $item['signOffAddress']=$sign['signOffAddress'];
                    }
                }else{
                    $item['sign']='未签到';
                }
                $list[]=$item;
            }
            return $list;
        }
        elseif ($signInType==1){
            $rel=DI()->notorm->meetinginfo->select('members,hasPhoto,test')->where('id',$meetingId)->fetchOne();
            $meetingJoin=explode(',', $rel['members']);
            $list=[];
            foreach ($meetingJoin as $key=>$joinId){
                $staff=DI()->notorm->staff->select('*')->where('id',$joinId)->fetchOne();
                $dept=DI()->notorm->department->select('*')->where('id',$staff['department'])->fetchOne();

                $sign=DI()->notorm->signin->select('*')->where('meetingId',$meetingId)->where('staffId',$joinId)->fetchOne();
                if ($sign['staffId']){
                    $item=array(
                        'name'=>$staff['name'],
                        'jobNum'=>$staff['jobNum'],
                        'deptName'=>$dept['deptName']
                    );
                    $item['sign']='已签到';
                    $item['signTime']=$sign['signTime'];
                    $item['address']=$sign['address'];
//                $item['photopath']=$sign['photopath'];
                    if ($rel['test']==1){
                        $test=DI()->notorm->answer->select('*')->where('userId',$joinId)->where('meetingId',$meetingId)->fetchOne();
                        if ($test['id']){
                            $item['test']=$test['fraction'].'分';
                        }else{
                            $item['test']='未答题';
                        }
                    }
                    $list[]=$item;
                }

            }
            return $list;
        }
        elseif ($signInType==2){
            $rel=DI()->notorm->meetinginfo->select('members,hasPhoto,test')->where('id',$meetingId)->fetchOne();
            $meetingJoin=explode(',', $rel['members']);
            $list=[];
            foreach ($meetingJoin as $key=>$joinId){
                $staff=DI()->notorm->staff->select('*')->where('id',$joinId)->fetchOne();
                $dept=DI()->notorm->department->select('*')->where('id',$staff['department'])->fetchOne();

                $sign=DI()->notorm->signin->select('*')->where('meetingId',$meetingId)->where('staffId',$joinId)->fetchOne();
                if ($sign['staffId']){

                }else{
                    $item=array(
                        'name'=>$staff['name'],
                        'jobNum'=>$staff['jobNum'],
                        'deptName'=>$dept['deptName']
                    );
                    $item['sign']='未签到';
                    $list[]=$item;
                }

            }
            return $list;
        }

    }


}