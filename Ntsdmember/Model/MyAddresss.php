<?php
/**
 * Created by PhpStorm.
 * User: zy
 * Date: 2018/9/20
 * Time: 10:46
 */



class Model_MyAddresss extends PhalApi_Model_NotORM
{

    public function getMyAddresssById($id){

        return DI()->notorm->members_address->where('member_id',$id)->fetchOne();

    }

    public function insertMyAddresss($data){

        try{
            //通过province省查询出对应的地图编码
            $province=DI()->notorm->province->where('name',$data['province'])->fetchOne();

            $data['map_code'] = $province['map_code'];

            DI()->notorm->members_address->insert($data);

            return true;
        }catch (Exception $e){

            return false;

        }

    }

    public function updateMyAddresss($data){
        //通过province省查询出对应的地图编码
        $province=DI()->notorm->province->where('name',$data['province'])->fetchOne();

         $res=DI()->notorm->members_address->where('member_id',$data['member_id'])
             ->update(array('consignee_name'=>$data['name'],'address'=>$data['address'],'consignee_phone'=>$data['phone'],
                 'city'=>$data['city'],'county'=>$data['county'],'province'=>$data['province'],'map_code'=>$province['map_code']));

        return $res;

    }
    public function getMyAddresssBySession3rd($openid){

        $order = DI()->notorm->members_address;

        $result = $order->where("openid",$openid)->fetchOne();

        return $result;

    }

    public function inAddress($openid){

        $address = DI()->notorm->members_address;

        $result = $address->where("openid",$openid)->fetchOne();

        $data=array();

        $data['shipping_address']=$result['address'];
        $data['province_code']=$result['map_code'];
        $data['province_name']=$result['province'];


        $order=DI()->notorm->commodity_order;

        $info=$order->where(array("members_id" =>$result['member_id'],"pay" =>1,"shipping_address"=>null))->update($data);

        return $info;

    }




}