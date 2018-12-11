<?php
/**
 * Created by PhpStorm.
 * User: zy
 * Date: 2018/9/20
 * Time: 10:46
 */



class Model_MyAddresss extends PhalApi_Model_NotORM
{

    /**
     * @param $data
     * @return bool
     * 新增我的地址
     */
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
     * @param $member_id
     * @return mixed
     * 查看我的地址,通过会员id查看地址信息
     */
    public function findAddressByMemberId($member_id){

        return DI()->notorm->member_address->where('member_id',$member_id)->fetchAll();
    }


    /**
     * @param $member_id
     * @return mixed
     * 通过id查看我的单个地址信息
     */
    public function findAddressById($id){

        return DI()->notorm->member_address->where('id',$id)->fetch();
    }

    /**
     * @param $id
     * @return mixed
     * 通过id修改单个收货信息
     */
    public function updateAddressById($data){

        //通过province省查询出对应的地图编码
        $province=DI()->notorm->province->where('name',$data->province)->fetchOne();

        $info=array(
            'address'=>$data->address,
            'consignee_name'=>$data->consignee_name,
            'consignee_phone'=>$data->consignee_phone,
            'city'=>$data->city,
            'county'=>$data->county,
            'province'=>$data->province,
            'map_code'=>$province['map_code'],
            'state'=>$data->state,
        );

        $rs=DI()->notorm->member_address->where('id',$data->id)->update($info);

        return $rs;
    }


    /**
     * @param $data
     * @return mixed
     * 通过id删除单个地址信息
     */
    public function deleteAddressById($id){

        return DI()->notorm->member_address->where('id',$id)->delete();

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