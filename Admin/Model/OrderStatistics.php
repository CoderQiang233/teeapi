<?php
/**
 * Created by PhpStorm.
 * User: ${zhouyuan}
 * Date: 2018/11/7
 * Time: 14:34
 */


class Model_OrderStatistics extends PhalApi_Model_NotORM
{


    public function getList($data)
    {
        $arr=array();

        $name=$data->member_name;

        $datestart=$data->datestart;

        $dateend=$data->dateend;

        $query=DI()->notorm->members;
        if ('undefined' !== $name && '' !== $name && null !== $name) {

            $query = $query->where('name', $name);
        }


        //获取所有已注册会员信息
        $member=$query->where(array("flag"=>Model_Member::ORDER_STATUS_1))->fetchAll();

        $a=count($member);
        //循环会员列表获取每个会员对应的订单信息
        for($i=0;$i<count($member);$i++){
            $select = DI()->notorm->commodity_order;

            if ('undefined' !== $datestart && '' !== $datestart && null !== $datestart) {
                //select fullName,addedTime FROM t_user where addedTime between  '2017-1-1 00:00:00'  and '2018-1-1 00:00:00';
                $select = $select->where('updatedAt >= ?',$datestart);

            }

            if ('undefined' !== $dateend && '' !== $dateend && null !== $dateend) {
                //select fullName,addedTime FROM t_user where addedTime between  '2017-1-1 00:00:00'  and '2018-1-1 00:00:00';
                $select = $select->where('updatedAt < ?',$dateend);

            }
            //通过会员id获取已支付的商品订单信息
            $commodity_order=$select->where(array('members_id'=>$member[$i]['id'],'pay'=>'1'))->fetchAll();

            $list=array();
            //获取到会员姓名
            $list['member_name']=$member[$i]['name'];
            //获取到会员手机号
            $list['member_phone']=$member[$i]['phone'];
            if($commodity_order){
                //获取到该商品总数和金额总计
                $commodity_num=0;
                //金额总计
                $price=0;
                for ($x=0;$x<count($commodity_order);$x++){
                    $commodity_num+=$commodity_order[$x]['commodity_num'];
                    $price+=$commodity_order[$x]['commodity_num']*$commodity_order[$x]['commodity_price'];
                }

                //获取到订单数量
                $list['order_num']=count($commodity_order);
                //商品总数
                $list['commodity_num']=$commodity_num;
                //金额总计
                $list['orders_price']=$price;


            }
            $arr[]=$list;

        }

        return $arr;

    }

}