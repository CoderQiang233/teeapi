<?php

/**
 * Created by PhpStorm.
 * User: lxl
 * Date: 2018/7/20
 * Time: 下午4:48
 */
class Domain_Invoice
{

    public function getInvoiceById($id){


        $model = new Model_Invoice();

        return $model -> getInvoiceById($id);

    }

    public function insertInvoice($data){

        $model = new Model_Invoice();

        return $model -> insertInvoice($data);

    }


    public function updateInvoice($data){

        $model = new Model_Invoice();

        return $model -> updateInvoice($data);

    }
}