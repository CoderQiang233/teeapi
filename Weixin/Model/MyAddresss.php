<?php
/**
 * Created by PhpStorm.
 * User: zy
 * Date: 2018/9/20
 * Time: 10:46
 */



class Model_MyAddresss extends PhalApi_Model_NotORM
{


    public function insertMyAddresss($data){

        try{
            //通过province省查询出对应的地图编码
            $province=DI()->notorm->province->where('name',$data->province)->fetchOne();

            $info=array(
                'openid'=>$data->openid,
                'address'=>$data->address,
                'consignee_name'=>$data->consignee_name,
                'consignee_phone'=>$data->consignee_phone,
                'create_time'=>date('Y-m-d H:i:s'),
                'member_id'=>$data->member_id,
                'city'=>$data->city,
                'county'=>$data->county,
                'province'=>$data->province,
                'map_code'=>$province['map_code'],
                'state'=>$data->state,
            );

            DI()->notorm->member_address->insert($info);

            return true;

        }catch (Exception $e){

            DI()->logger->error('insert','新增我的地址失败Model:'.$e);

            return false;

        }

    }

    /**
     * 查看某会员是否有默认地址
     */
    public function getAddressState($member_id){

        return DI()->notorm->member_address->select('SUM(state) AS stateTotal')->where('member_id',$member_id)->fetch();
    }

    /**
     * @param $member_id
     * @return mixed
     * 将会员地址的state更新为0
     */
    public function  updateState($member_id){

        return DI()->notorm->member_address->where('member_id',$member_id)->update(array('state'=>0));
    }





}