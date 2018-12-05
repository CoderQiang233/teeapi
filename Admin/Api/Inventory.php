<?php

/**
 * 库存管理
 *
 * @author: dogstar <chanzonghuang@gmail.com> 2014-10-04
 */
class Api_Inventory  extends PhalApi_Api{


    /**
     * @return array
     */
    public function getRules() {
        return array(
            'editTotalInventory'=> array(
                'product_id' => array('name' => 'product_id', 'type' => 'string', 'require' => true, 'desc' => '商品id'),
                'member_id'=> array('name' => 'member_id',  'type' => 'int',  'desc' => '会员id'),
                'name'=> array('name' => 'name', 'type' => 'string',  'desc' => '会员真实姓名'),
                'num' => array('name' => 'num', 'type' => 'int', 'require' => true, 'desc' => '出入库前库存'),
                'change_inventory'=> array('name' => 'change_inventory',  'type' => 'int', 'require' => true, 'desc' => '改变的库存(出入库数量)'),
                'userName'=> array('name' => 'userName', 'type' => 'string',   'desc' => '操作人用户号'),
                'user_name'=> array('name' => 'user_name', 'type' => 'string',   'desc' => '操作人真实姓名'),
            ),
            'getInventoryRecordTotal'=> array(
                'product_id' => array('name' => 'product_id', 'type' => 'string', 'require' => true, 'desc' => '商品id'),
                'state' => array('name' => 'state', 'type' => 'string',  'desc' => '出库，入库(1出库   2入库)'),
                'pageSize'=> array('name' => 'pageSize',  'type' => 'int', 'require' => true, 'desc' => '每页条数'),
                'pageIndex'=> array('name' => 'pageIndex', 'type' => 'int', 'require' => true,  'desc' => '跳转页码'),
            ),
            'getInventoryAgent'=> array(
                'product_id' => array('name' => 'product_id', 'type' => 'string', 'desc' => '商品id'),
                'product_name' => array('name' => 'product_name', 'type' => 'string', 'desc' => '商品名称'),
                'name' => array('name' => 'name', 'type' => 'string',  'desc' => '会员真实姓名'),
                'pageSize'=> array('name' => 'pageSize',  'type' => 'int', 'require' => true, 'desc' => '每页条数'),
                'pageIndex'=> array('name' => 'pageIndex', 'type' => 'int', 'require' => true,  'desc' => '跳转页码'),
            ),
            'getAgentProductRecord'=> array(
                'product_id' => array('name' => 'product_id', 'type' => 'string', 'require' => true, 'desc' => '商品id'),
                'member_id'=> array('name' => 'member_id',  'type' => 'int', 'require' => true,  'desc' => '会员id'),
                'state' => array('name' => 'state', 'type' => 'string',  'desc' => '出库，入库(1出库   2入库)'),
                'pageSize'=> array('name' => 'pageSize',  'type' => 'int', 'require' => true, 'desc' => '每页条数'),
                'pageIndex'=> array('name' => 'pageIndex', 'type' => 'int', 'require' => true,  'desc' => '跳转页码'),
            ),

        );
    }


    /**
     * 总部添加库存
     * @desc  总部添加库存
     */
    public function editTotalInventory(){

        $rs = array('code' => 0, 'msg' => '', 'info' => array());

        $product = new Domain_Inventory();

        $result = $product->editTotalInventory($this);

        if($result){

            $rs['code'] = 1;

            $rs['info'] = $result;
        }

        return $rs;

    }

    /**
     * 查看总部的库存明细
     * @desc 查看总部的库存明细
     */
    public function getInventoryRecordTotal(){

        $rs = array('code' => 0, 'msg' => '', 'info' => array());

        $product = new Domain_Inventory();

        $result = $product->getInventoryRecordTotal($this);

        if($result){

            $rs['code'] = 1;

            $rs['info'] = $result;
        }

        return $rs;

    }

    /**
     * 查看代理库存
     * @desc  查看代理库存
     */
    public function getInventoryAgent(){

        $rs = array('code' => 0, 'msg' => '', 'info' => array());

        $product = new Domain_Inventory();

        $result = $product->getInventoryAgent($this);

        if($result){

            $rs['code'] = 1;

            $rs['info'] = $result;
        }

        return $rs;

    }

    /**
     * 查看代理单个商品库存明细
     * @desc  查看代理单个商品库存明细
     */
    public function getAgentProductRecord(){

        $rs = array('code' => 0, 'msg' => '', 'info' => array());

        $domain = new Domain_Inventory();

        $result = $domain->getAgentProductRecord($this);

        if($result){

            $rs['code'] = 1;

            $rs['info'] = $result;
        }

        return $rs;
    }

}