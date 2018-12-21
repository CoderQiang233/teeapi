<?php
/**
 * Created by PhpStorm.
 * User: ${zhouyuan}
 * Date: 2018/10/19
 * Time: 15:37
 */


class Model_AgentCashback extends PhalApi_Model_NotORM
{

    public  function getList($data){

        $pageSize='';//每页条数

        $pageIndex='';//当前页

        $phone='';//手机号

        $nick_name='';//微信昵称

        //查看是推客的信息    是否为推客（0 否 1是）
        $promoter=DI()->notorm->members->where('is_promoter',1);

        if('undefined' !== $data->pageSize && '' !== $data->pageSize && null !== $data->pageSize ){

            $pageSize=$data->pageSize;
        }

        if('undefined' !== $data->pageIndex && '' !== $data->pageIndex && null !== $data->pageIndex ){

            $pageIndex=$data->pageIndex;
        }

        $start_page=($pageIndex-1)*$pageSize;

        if('undefined' !== $data->phone && '' !== $data->phone && null !== $data->phone ){

            $phone=$data->phone;

            $promoter->where('phone',$phone);
        }

        if('undefined' !== $data->nick_name && '' !== $data->nick_name && null !== $data->nick_name ){

            $nick_name=$data->nick_name;

            $promoter->where('nick_name LIKE ?','%'.$nick_name.'%');
        }

        $total=count($promoter->fetchAll());

        $res=$promoter->order('balance DESC')->limit($start_page, $pageSize)->fetchAll();

        foreach ($res as $k=>$v){
            //总返现金额
            $total_balance=DI()->notorm->commission_history->where(array('type'=>0,'member_id'=>$v['id']))->sum('total');

            //未结算金额
            $no_balance=DI()->notorm->commission_history->where(array('type'=>0,'status'=>0,'member_id'=>$v['id']))->sum('total');

            //总返现金额
            $res[$k]['total_balance']=$total_balance?$total_balance:0;

            $res[$k]['no_balance']=$no_balance?$no_balance:0;

           //已结算金额=总返现金额-未结算金额
            $yes_balance=bcsub($total_balance,$no_balance,2);

            //已用金额=已结算金额-可用金额
            $had_balance=bcsub($yes_balance,$v['balance'],2);

            $res[$k]['yes_balance']=$yes_balance;

            $res[$k]['had_balance']=$had_balance;
        }

        return array(
            'promoters' => $res,
            'total' => $total,
            'pageIndex' => $pageIndex,
        );
    }

}