<?php



/**
 * Created by PhpStorm.
 * User: zy
 * Date: 2018/7/20
 * Time: 下午4:48
 */
class Domain_MyAddresss
{

    public function insertMyAddresss($data){

        try{

            $model = new Model_MyAddresss();

            $state=$data->state;

            $addressState=$model->getAddressState($data->member_id);

            if ($state==1&&$addressState['stateTotal']==1){//有默认地址,先将该会员的其他地址信息的state都改为0,再插入

                $model->updateState($data->member_id);
            }

            $res=$model->insertMyAddresss($data);

            return $res;

        }catch(Exception $e){

            DI()->logger->error('insert','新增我的地址失败Domain:'.$e);

            return false;
        }

    }

    public function  findAddressByMemberId($data){

        try{

            $model=new Model_MyAddresss();

            $res=$model->findAddressByMemberId($data->member_id);

            return $res;

        }catch (Exception $e){

            DI()->logger->error('查看会员地址信息失败','会员id:'.$data->member_id.'异常信息:'.$e);

            return false;
        }
    }

    public function  findAddressById($data){

        try{

            $model=new Model_MyAddresss();

            $res=$model->findAddressById($data->id);

            return $res;

        }catch (Exception $e){

            DI()->logger->error('通过id查看我的单个地址信息失败','id:'.$data->id.'异常信息:'.$e);

            return false;
        }
    }

    public function  updateAddressById($data){

        try{

            $model=new Model_MyAddresss();

            $state=$data->state;

            $addressState=$model->getAddressState($data->member_id);

            if ($state==1&&$addressState['stateTotal']==1){//有默认地址,先将该会员的其他地址信息的state都改为0,再更新

                $model->updateState($data->member_id);
            }

            $res=$model->updateAddressById($data);

            return $res;

        }catch (Exception $e){

            DI()->logger->error('通过id修改单个收货信息失败','id:'.$data->id.'异常信息:'.$e);

            return false;
        }
    }

    public function  deleteAddressById($data){

        try{

            $model=new Model_MyAddresss();

            $res=$model->deleteAddressById($data->id);

            return $res;

        }catch (Exception $e){

            DI()->logger->error('通过id删除单个地址信息失败','id:'.$data->id.'异常信息:'.$e);

            return false;
        }
    }



}