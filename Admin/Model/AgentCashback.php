<?php
/**
 * Created by PhpStorm.
 * User: ${zhouyuan}
 * Date: 2018/10/19
 * Time: 15:37
 */


class Model_AgentCashback extends PhalApi_Model_NotORM
{
    const ORDER_STATUS_1 = 1; // 已支付
    public function getMemberList($data)
    {
        $name = $data->name;
        $phone = $data->phone;
        $sqbh = $data->authorization_number;
        $where = '';
        $select = DI()->notorm->members;
        if ('undefined' !== $name && '' !== $name && null !== $name) {
            $where = $where . ' AND name="' . $name . '"';
            $select = $select->where('name', $name);
        }
        if ('undefined' !== $phone && '' !== $phone && null !== $phone) {
            $where = $where . ' AND phone="' . $phone . '"';
            $select = $select->where('phone', $phone);
        }
        if ('undefined' !== $sqbh && '' !== $sqbh && null !== $sqbh) {
            $where = $where . ' AND authorization_number="' . $sqbh . '"  ';
            $select = $select->where('authorization_number', $sqbh);
        }

        $pageSize='';//每页条数

        $pageIndex='';//当前页



        if('undefined' !== $data->pageSize && '' !== $data->pageSize && null !== $data->pageSize ){

            $pageSize=$data->pageSize;

        }

        if('undefined' !== $data->pageIndex && '' !== $data->pageIndex && null !== $data->pageIndex ){

            $pageIndex=$data->pageIndex;

        }

        $start_page=$pageSize*($pageIndex-1);

        $sql='SELECT m.*,ma.address '
            .'FROM members m LEFT JOIN members_address ma '
            .'ON m.id=ma.member_id '
            .' WHERE 1=1 AND flag=1 AND level!=1 '.$where
            .'ORDER BY m.level desc,m.id  LIMIT :start_page ,:pageSize';

        $params = array(':pageSize' => intval($pageSize),':start_page' =>$start_page);

        $rows = $this->getORM()->queryAll($sql, $params);
        $a=count($rows);
        for($i=0;$i<count($rows);$i++){
            //获取每个代理商下月返现记录详情
            $csid=$rows[$i]['id'];
            $cashmonth=DI()->notorm->cash_month_record->where(array('cash_id'=>$rows[$i]['id']))->fetchAll();

            if($cashmonth){
                $zongcash='';
                for($x=0;$x<count($cashmonth);$x++){
                    $zongcash+=$cashmonth[$x]['cash_price'];
                    $rows[$i]['zongcash']=$zongcash;
                }
            }else {
                $rows[$i]['zongcash'] = '';
            }

        }
        $total=count($select->where(array("flag"=>Model_Member::ORDER_STATUS_1,'NOT level'=>1)));

        $arry = array(
            'list' => $rows,
            'total' => $total,
            'pageIndex' => $pageIndex,
        );
        return $arry;

    }
          //废弃方法
    public function ces($data){
        $id=$data->id;

        $members=DI()->notorm->members->where('id',$id)->fetch();

        $phone=$members['phone'];

        $timestamp=strtotime(date("Y-m"));
        //上月第一天
        $firstday=date('Y-m',strtotime(date('Y',$timestamp).'-'.(date('m',$timestamp)-1)));
        //上月最后一天
        //$lastday=date('Y-m',strtotime("$firstday +1 month -1 day"));

        $month=$firstday.'%';
        //获取到该用户的上月代理商信息
        $daili=DI()->notorm->members->where(array('referee_phone'=>$phone,'updatedAt LIKE '.$month,"flag"=>Model_Member::ORDER_STATUS_1))->fetchAll();

        $count=count($daili);//代理总数

        $cash=0;
        if($count!=0){
            for($x=0;$x<$count;$x++){
                $cash+=$daili[$x]['level_price'];
            }
            //插入代理返现金额到返现记录表中
            //通过当月和会员id查询上月是否已经进入过记录表
            $sfcr=DI()->notorm->cash_record->where(array('member_id'=>$id,'cash_time'=>$firstday))->fetchAll();
            if(!$sfcr){
                $cashRecord=array();
                $cashRecord['member_id']=$id;
                $cashRecord['cash_time']=$firstday;
                $cashRecord['cash_money']=$cash.'';
                $cashRecord['status']=1;//1未返现2已返现
                DI()->notorm->cash_record->insert($cashRecord);
            }
        }

        $cashMsg=DI()->notorm->cash_record->where(array('member_id'=>$id))->fetchAll();
        //上月返现记录
        $cashMsg1=DI()->notorm->cash_record->where(array('member_id'=>$id,'cash_time'=>$firstday))->fetch();
        $oneRmb=$cashMsg1['cash_money'];

        //上上月第一天
        $lastmonth=date('Y-m',strtotime(date('Y',$timestamp).'-'.(date('m',$timestamp)-2)));

        //上上月返现记录
        $cashMsg2=DI()->notorm->cash_record->where(array('member_id'=>$id,'cash_time'=>$lastmonth))->fetch();
        $twoRmb=$cashMsg2['cash_money'];
            switch ($members['level'])
            {
                case 2:
                    $yfx=$oneRmb*0.15*0.7+$twoRmb*0.15*0.3;
                    break;
                case 3:
                    $yfx=$oneRmb*0.3*0.7+$twoRmb*0.3*0.3;
                    break;
                case 4:
                    $yfx=$oneRmb*0.3*0.7+$twoRmb*0.3*0.3;
                    break;
                default:
                    return;
            }


       return  $arry = array(
            'list' => $cashMsg,
//            'total' => $total,
//            'pageIndex' => $pageIndex,
        );


    }
    public  function  getAgentCashbackList($data){
        $id=$data->id;

        $member_name=$data->member_name;

        $record_date=$data->record_date;

        $pageSize='';//每页条数

        $pageIndex='';//当前页

        $select=DI()->notorm->cash_record;

        if('undefined' !== $data->pageSize && '' !== $data->pageSize && null !== $data->pageSize ){

            $pageSize=$data->pageSize;

        }

        if('undefined' !== $data->pageIndex && '' !== $data->pageIndex && null !== $data->pageIndex ){

            $pageIndex=$data->pageIndex;

        }

        if ('undefined' !== $member_name && '' !== $member_name && null !== $member_name) {

            $select = $select->where('member_name', $member_name);
        }

        if ('undefined' !== $record_date && '' !== $record_date && null !== $record_date) {

            $select = $select->where('record_date', $record_date);
        }

        $start_page=$pageSize*($pageIndex-1);

        $list=$select->where(array('referee_id'=>$id))->limit($start_page,$pageSize)->fetchAll();

        $total=count($select);

        return $arry = array(
            'list' => $list,
            'total' => $total,
            'pageIndex' => $pageIndex,
        );
    }
    public  function getMemberListMsg($data){
        $id=$data->id;

        $status=$data->status;

        $pageSize='';//每页条数

        $pageIndex='';//当前页

        $select=DI()->notorm->cash_month_record;

        $where = '';
        if('undefined' !== $data->pageSize && '' !== $data->pageSize && null !== $data->pageSize ){

            $pageSize=$data->pageSize;

        }

        if('undefined' !== $data->pageIndex && '' !== $data->pageIndex && null !== $data->pageIndex ){

            $pageIndex=$data->pageIndex;

        }

        if ('undefined' !== $status && '' !== $status && null !== $status) {

            $select = $select->where('status', $status);
        }
        $start_page=$pageSize*($pageIndex-1);

        $list=$select->where(array('cash_id'=>$id))->limit($start_page,$pageSize)->fetchAll();

        $total=count($select);

        return  $arry = array(
            'list' => $list,
            'total' => $total,
            'pageIndex' => $pageIndex,
        );
    }
    public  function  updateCashStatus($data){

         //更改返现状态为已返现
        DI()->notorm->cash_month_record->where('id',$data->id)->update(array('status'=>'1','operation'=>$data->operation));

        return true;
    }
    //获取月返现明细
    public  function  getAgentCashbackMonthList($data){
        $id=$data->id;

        $member_name=$data->member_name;

        $record_date=$data->record_date;

        $month=$data->month;

        $pageSize='';//每页条数

        $pageIndex='';//当前页

        $select=DI()->notorm->cash_record;

        if('undefined' !== $data->pageSize && '' !== $data->pageSize && null !== $data->pageSize ){

            $pageSize=$data->pageSize;

        }

        if('undefined' !== $data->pageIndex && '' !== $data->pageIndex && null !== $data->pageIndex ){

            $pageIndex=$data->pageIndex;

        }

        if ('undefined' !== $member_name && '' !== $member_name && null !== $member_name) {

            $select = $select->where('member_name', $member_name);
        }

        if ('undefined' !== $record_date && '' !== $record_date && null !== $record_date) {

            $select = $select->where('record_date', $record_date);
        }

        $start_page=$pageSize*($pageIndex-1);

        $list=$select->where(array('referee_id'=>$id,'record_date'=>$month))->limit($start_page,$pageSize)->fetchAll();

        $total=count($select);

        return $arry = array(
            'list' => $list,
            'total' => $total,
            'pageIndex' => $pageIndex,
        );
    }
}