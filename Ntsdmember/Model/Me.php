<?php

/**
 * Created by PhpStorm.
 * User: lxl
 * Date: 2018/7/19
 * Time: 下午5:13
 */
class Model_Me extends PhalApi_Model_NotORM
{

    public function index($openid){

        $order = DI()->notorm->members;

        $result = $order->where(array("flag" => Domain_Pay::ORDER_STATUS_1,"openid" => $openid ))->fetchOne();

        return $result;

    }
    public function getkucun($openid){

//        计算总计库存
        $order = DI()->notorm->members;
        $result = $order->where(array("flag" => Domain_Pay::ORDER_STATUS_1,"openid" => $openid ))->fetchOne();
        $id=$result['id'];
        $a=DI()->notorm->commodity_order->where(array('members_id'=>$id,'pay'=>1))->fetchAll();
        $numa=0;
        $numb=0;
        for($i=0;$i<count($a);$i++){
            $j=$a[$i];
            $numa+=$j['commodity_num'];
            $b=DI()->notorm->commodity_express->where('order_id',$j['id'])->fetchAll();
            for($n=0;$n<count($b);$n++){
                $m=$b[$n];
                $numb+=$m['ship_num'];
            }
        }
        $info=array();
        $info['kucun']=$numa-$numb;

//      计算本月佣金
        //获取月记录
        $current=date("Y-m",time());//获取当前年月
        $ssss=DI()->notorm->cash_month_record->where(array('cash_id'=>$id,'cash_time'=>$current))->fetchOne();
        $info['Bmoney']=$ssss['cash_price']+0;
//      计算累计佣金
        $zong=DI()->notorm->cash_month_record->where(array('cash_id'=>$id,'status'=>1))->fetchAll();
        $zongs=0;
        for($i=0;$i<count($zong);$i++){
            $zongs+=$zong[$i]['cash_price'];
        }
        $info['Amoney']=$zongs;
        return $info;

    }


    public function getfanxian($openid,$curentmonth){

        $order = DI()->notorm->members;
        $result = $order->where(array("flag" => Domain_Pay::ORDER_STATUS_1,"openid" => $openid ))->fetchOne();
        $id=$result['id'];

        if($curentmonth){
            $current=date("Y-m",time());
            $res=DI()->notorm->cash_record->where(array('referee_id'=>$id,'record_date'=>$current))->fetchAll();
            for($i=0;$i<count($res);$i++){
                $tou=DI()->notorm->members->where(array('id'=>$res[$i]['member_id']))->fetchOne();
                $res[$i]['head_portrait']=$tou['head_portrait'];
                $res[$i]['level_info']=$tou['level_info'];
            }
            return $res;
        }
        else{
            $res=DI()->notorm->cash_record->where('referee_id',$id)->fetchAll();
            for($i=0;$i<count($res);$i++){
                $tou=DI()->notorm->members->where(array('id'=>$res[$i]['member_id']))->fetchOne();
                $res[$i]['head_portrait']=$tou['head_portrait'];
                $res[$i]['level_info']=$tou['level_info'];
            }
            return $res;
        }

    }

    public function GetQualification($openid){

        $member = DI()->notorm->members;
        $order = DI()->notorm->commodity_order;


        $result = $member->where(array("flag" => Domain_Pay::ORDER_STATUS_1,"openid" => $openid ))->fetchOne();
        $level=$result['level'];
        $id=$result['id'];
        $order_result=$order->where(array("pay" => Domain_Pay::ORDER_STATUS_1,"members_id" => $id,"order_type"=>2 ))->fetchAll();
        $res=false;
        switch ($level) {
            case 1:
                    $res=true;
                break;
            case 2:
                $num=0;
                foreach ($order_result as $o){
                    $num+=$o['commodity_num'];
                }
                if($num>=90){
                    $res=true;
                }

                break;
            case 3:
                foreach ($order_result as $o){
                    if($o['commodity_num']>=100){
                        $res=true;
                    }
                }
                break;
        }
        return $res;

    }


}