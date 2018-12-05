<?php

/**
 * 发票接口
 */
class Api_Invoice extends PhalApi_Api
{

    public function getRules() {
        return array(
            'getInvoiceById' => array(
                'id' 	=> array('name' => 'id', 'type' =>'string','require' => true)
            ),
            'updateInvoice' => array(
                'name' => array('name'=>'name','type' =>'string','require' => true,'source' => 'post'),
                'address' => array('name'=>'address','type' =>'string','require' => true,'source' => 'post'),
                'phone' => array('name'=>'phone','type' =>'string','require' => true,'source' => 'post'),
                'khbank' => array('name'=>'khbank','type' =>'string','require' => true,'source' => 'post'),
                'banknum' =>array('name'=>'banknum','type' =>'string','require' => true,'source' => 'post'),
                'paynum' =>array('name'=>'paynum','type' =>'string','require' => true,'source' => 'post'),
                'member_id' =>array('name'=>'member_id','type' =>'string','require' => true,'source' => 'post'),
            ),
            'insertInvoice' => array(
                'name' => array('name'=>'name','type' =>'string','require' => true,'source' => 'post'),
                'address' => array('name'=>'address','type' =>'string','require' => true,'source' => 'post'),
                'phone' => array('name'=>'phone','type' =>'string','require' => true,'source' => 'post'),
                'khbank' => array('name'=>'khbank','type' =>'string','require' => true,'source' => 'post'),
                'banknum' =>array('name'=>'banknum','type' =>'string','require' => true,'source' => 'post'),
                'paynum' =>array('name'=>'paynum','type' =>'string','require' => true,'source' => 'post'),
                'member_id' =>array('name'=>'member_id','type' =>'string','require' => true,'source' => 'post'),
            ),
        );
    }


    public function getInvoiceById(){

        $id = $this -> id;

        $rs = array('code' => 0, 'msg' => '', 'info' => array());

        $domain = new Domain_Invoice();

        $result = $domain -> getInvoiceById($id);

        if($result){

            $rs['code'] = 1;

            $rs['info'] = $result;

        }

        return $rs;


    }


    public function insertInvoice(){


        $rs = array('code' => 0, 'msg' => '', 'info' => array());


        $data = array();

        $data['id'] = time();

        $data['name'] = $this -> name;

        $data['address'] = $this -> address;

        $data['phone'] = $this -> phone;

        $data['khbank'] = $this -> khbank;

        $data['banknum'] = $this -> banknum;

        $data['paynum'] = $this -> paynum;

        $data['member_id'] = $this->member_id;

        $domain = new Domain_Invoice();

        $res = $domain->insertInvoice($data);

        if($res){

            $rs['code'] = 1;

        }

        return $rs;



    }

    public function updateInvoice(){

        $rs = array('code' => 0, 'msg' => '', 'info' => array());


        $data = array();

        $data['name'] = $this -> name;

        $data['address'] = $this -> address;

        $data['phone'] = $this -> phone;

        $data['khbank'] = $this -> khbank;

        $data['banknum'] = $this -> banknum;

        $data['paynum'] = $this -> paynum;

        $data['member_id'] = $this->member_id;

        $domain = new Domain_Invoice();

        $res = $domain->updateInvoice($data);

        if($res){

            $rs['code'] = 1;

        }

        return $rs;



    }



}