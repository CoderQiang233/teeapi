<?php
/**
 * Created by PhpStorm.
 * User: ${zhouyuan}
 * Date: 2018/10/23
 * Time: 15:19
 */

class Model_City extends PhalApi_Model_NotORM
{

    public function getCityList($data)
    {

        $city=DI()->notorm->city->order('id DESC')->fetchAll();
        $county=DI()->notorm->county->order('id DESC')->fetchAll();
        $province=DI()->notorm->province->order('id DESC')->fetchAll();

        $citys=array();
        $countys=array();
        $provinces=array();

        for ($i=0;$i<count($city);$i++){
            $wx_code=$city[$i]['wx_code'];
            $name=$city[$i]['name'];
            $citys[$wx_code]=$name;

        }

        for ($i=0;$i<count($county);$i++){
            $wx_code=$county[$i]['wx_code'];
            $name=$county[$i]['name'];
            $countys[$wx_code]=$name;

        }

        for ($i=0;$i<count($province);$i++){
            $wx_code=$province[$i]['wx_code'];
            $name=$province[$i]['name'];
            $provinces[$wx_code]=$name;

        }
        $city_list=array(
            'city_list'=>$citys,
            'county_list'=>$countys,
            'province_list'=>$provinces,
        );
        return $city_list;
    }

}