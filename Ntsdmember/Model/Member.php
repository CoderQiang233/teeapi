<?php

/**
 * Created by PhpStorm.
 * User: lxl
 * Date: 2018/7/17
 * Time: 下午3:38
 */
class Model_Member extends PhalApi_Model_NotORM
{
    public function getList(){

        return DI()->notorm->members_level->fetchAll();

    }

    public function getById($id){

        return DI()->notorm->member_info->where('id',$id) -> fetchOne();

    }

    public function checkPhone($phone){

        return DI()->notorm->members->where('phone',$phone) ->where('flag',1) ->fetchOne();

    }

    public function checkIdcard($idcard){

        return DI()->notorm->members->where('idcard',$idcard) ->where('flag',1) ->fetchOne();

    }

    public function checkRefereePhone($phone){

        return DI()->notorm->members->where('phone',$phone) ->where('flag',1) ->where('level > ?',1) ->fetchOne();

    }
    public function getrefereeByPhone($phone){

        $list=DI()->notorm->members->where(array("flag" => Domain_Pay::ORDER_STATUS_1,"referee_phone" => $phone ))->fetchAll();

        for($l=0;$l<count($list);$l++){
            $one=$list[$l];

            $product=DI()->notorm->commodity_order->where(array("pay" => Domain_Pay::ORDER_STATUS_1,"members_id" =>$one['id'] ))->fetchAll();
//            $list[$l]['product']=$product;
            if($product){
                $list[$l]['product_num']=DI()->notorm->commodity_order->select('commodity_name, product_id, SUM(commodity_num) as amount')->where(array("pay" => Domain_Pay::ORDER_STATUS_1,"members_id" =>$one['id'] ))->group('product_id')->fetchAll();
            }

//            if($product){
//                $list[$l]['product_num']=0;
//                for($i=0;$i<count($product);$i++){
//                    $p=$product[$i];
//                    $list[$l]['product_num']+=$p['commodity_num'];
//
//                }
//            }else{
//                $list[$l]['product_num']=0;
//            }

        }
        return $list;



    }

}