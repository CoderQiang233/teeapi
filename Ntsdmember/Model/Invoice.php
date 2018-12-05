<?php

/**
 * Created by PhpStorm.
 * User: lxl
 * Date: 2018/7/20
 * Time: 下午4:48
 */
class Model_Invoice extends PhalApi_Model_NotORM
{

    public function getInvoiceById($id){

       return DI()->notorm->invoice->where('member_id',$id)->fetchOne();

    }

    public function insertInvoice($data){

        try{

            DI()->notorm->invoice->insert($data);

            return true;
        }catch (Exception $e){

            return false;

        }

    }

    public function updateInvoice($data){


        return  DI()->notorm->invoice->where('member_id',$data['member_id']) ->update(array('name'=>$data['name'],'address'=>$data['address'],'phone'=>$data['phone']
        ,'khbank' => $data['khbank'],'banknum' => $data['banknum'],'paynum'=>$data['paynum']
        ));



    }

}