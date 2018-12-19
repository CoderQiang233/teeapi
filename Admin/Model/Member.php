<?php
/**
 * Created by PhpStorm.
 * User: ${zhouyuan}
 * Date: 2018/9/26
 * Time: 14:34
 */
class Model_Member extends PhalApi_Model_NotORM
{

    public  function getList($data){

        $pageSize='';//每页条数

        $pageIndex='';//当前页

        $phone='';//手机号

        if('undefined' !== $data->pageSize && '' !== $data->pageSize && null !== $data->pageSize ){

            $pageSize=$data->pageSize;
        }

        if('undefined' !== $data->pageIndex && '' !== $data->pageIndex && null !== $data->pageIndex ){

            $pageIndex=$data->pageIndex;
        }

        $start_page=($pageIndex-1)*$pageSize;

        if('undefined' !== $data->phone && '' !== $data->phone && null !== $data->phone ){

            $phone=$data->phone;

            $res=DI()->notorm->members->where('phone',$phone)->limit($start_page, $pageSize)->order('id DESC')->fetchAll();

            $total=count(DI()->notorm->members->where('phone',$phone)->fetchAll());
        }else{

            $res=DI()->notorm->members->limit($start_page, $pageSize)->order('id DESC')->fetchAll();

            $total=count(DI()->notorm->members->fetchAll());
        }

        return array(
            'members' => $res,
            'total' => $total,
            'pageIndex' => $pageIndex,
        );

    }

}