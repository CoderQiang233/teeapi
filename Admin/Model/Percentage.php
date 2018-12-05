<?php
/**
 * Created by PhpStorm.
 * User: ${zhouyuan}
 * Date: 2018/11/9
 * Time: 14:44
 */
class Model_Percentage extends PhalApi_Model_NotORM
{


    public function getList($data)
    {
        try {
            //查询
            $list=DI()->notorm->cashback_percentage->fetchAll();

            return $list;

        } catch (Exception $e) {
            echo $e->getMessage();

            return "error";
        }
    }
    public function insertPercentage($data)
    {
        try{
            $info = array(
                'level' => $data->level,
                'cashback_percentage' =>$data->cashback_percentage,
                'cashback_price'=>$data->cashback_price,
                'operation'=>$data->operation,
            );
            $cashback_percentage=DI()->notorm->cashback_percentage->where('level', $data->level)->fetchAll();
            if($cashback_percentage){
                 return '该等级返现比例已存在!';
            }else{
                $result = DI()->notorm->cashback_percentage->insert($info);
                return true;
            }
        }catch (Exception $e){
            echo $e->getMessage();

            return "error";

        }

    }
    public function updatePercentage($data)
    {

        try {
            $cashback_price=$data->cashback_price;
            if ('undefined' !== $cashback_price && '' !== $cashback_price && null !== $cashback_price) {
                $info = array(
                    'level' => $data->level,
                    'cashback_percentage' =>$data->cashback_percentage,
                    'cashback_price'=>$data->cashback_price,
                    'operation'=>$data->operation,
                );
            }else {
                $info = array(
                    'level' => $data->level,
                    'cashback_percentage' =>$data->cashback_percentage,
                    'operation'=>$data->operation,
                );
            }

            DI()->notorm->cashback_percentage->where('id', $data->id)->update($info);

            return true;


        } catch (Exception $e) {
            return false;
        }
    }
    public function deleteById($id)
    {

        try {
            //删除
            DI()->notorm->cashback_percentage->where('id', $id)->delete();

            return "success";

        } catch (Exception $e) {
            echo $e->getMessage();

            return "error";
        }
    }
}