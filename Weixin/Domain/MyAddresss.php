<?php



/**
 * Created by PhpStorm.
 * User: zy
 * Date: 2018/7/20
 * Time: 下午4:48
 */
class Domain_MyAddresss
{

    public function getMyAddresssById($id){


        $model = new Model_MyAddresss();

        return $model -> getMyAddresssById($id);

    }

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


    public function updateMyAddresss($data){

        $model = new Model_MyAddresss();

        return $model -> updateMyAddresss($data);

    }

    public function getMyAddresssBySession3rd($openid){

        $model = new Model_MyAddresss();

        return $model ->getMyAddresssBySession3rd($openid);


    }

    public function inAddress($openid){

        $model = new Model_MyAddresss();

        return $model ->inAddress($openid);


    }

}