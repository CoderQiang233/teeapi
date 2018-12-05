<?php

/**
 * Created by PhpStorm.
 * User: lxl
 * Date: 2018/7/17
 * Time: 下午3:38
 */
class Model_Product extends PhalApi_Model_NotORM
{
    public function getList(){

        return DI()->notorm->commodity->fetchAll();

    }

//    public function getById($id){
//
//        return DI()->notorm->commodity->where('id',$id) -> fetchOne();
//
//    }



//    public function getByOpenId($openId){
//
//        $member=DI()->notorm->members;
//
//        $sql = ' SELECT m.*, l.productp from members  m '.
//              ' LEFT JOIN members_level  l ON m.LEVEL = l.id '.
//              '  where m.openid= :openid and m.flag=1';  //使用问号表示变量
//        $params = array(':openid' => $openId);
//        $rs= $member->queryRows($sql, $params);
//
//        if(count($rs)>0){
//            return $rs[0];
//        }else{
//            return false;
//        }
//
//    }

    public function getById($id){

        $result=DI()->notorm->commodity->where('id',$id) -> fetchOne();

        $bannerAll=DI()->notorm->banner->where('product_id',$id) -> fetchAll();

        $banners=array();

        $imgUrl=DI()->config->get('app.imagePath');

        for($i=0;$i<count($bannerAll);$i++){
            $banners[$i]['uid']=$bannerAll[$i]['id'];
            $banners[$i]['url']=$imgUrl.$bannerAll[$i]['path'];
        }
        $result['banners']=$banners;

        return $result;

    }

    public function getByOpenId($openId){

        $member=DI()->notorm->members->where(array('openid'=>$openId,'flag'=>1))->fetchOne();

        return $member;

    }

    /**
     * @param $id
     * @return bool
     * 获取用户订单 王
     */
    public function getMemberOrder($id){

        $order=DI()->notorm->commodity_order;

        $sql = 'select o.*,e.express_name,e.express_number,e.ship_time,e.ship_num,e.status  
                from commodity_order AS o LEFT JOIN 
                commodity_express AS e ON o.id = e.order_id
                where o.members_id = :id and o.pay = 1 ORDER BY o.id desc';  //使用问号表示变量
        $params = array(':id' => $id);
        $rs= $order->queryAll($sql, $params);

        for($i=0;$i<count($rs);$i++){
            $order=$rs[$i];
            //总的发货数量
            $shipnum=DI()->notorm->commodity_express->where('order_id',$order['id'])->sum('ship_num');
            $rs[$i]['shipnum']=$shipnum==null?0:$shipnum;
            $first_picture=DI()->notorm->commodity->where('id',$rs[$i]['product_id'])->fetchOne();
            $rs[$i]['first_picture']=$first_picture['first_picture'];
        }

        if(count($rs)>0){
            return $rs;
        }else{
            return false;
        }

    }

}