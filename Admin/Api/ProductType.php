<?php

/**
 * 商品类别类别管理
 */
class Api_ProductType  extends PhalApi_Api{


    public function getRules() {
        return array(
            'getList'=> array(
                'name' => array('name' => 'name', 'type' => 'string',  'desc' => '类别名称'),
            ),
            'insert'=> array(
                'name' => array('name' => 'name', 'type' => 'string', 'require' => true, 'desc' => '商品类别名称'),
                'image_url'=> array('name' => 'image_url',  'type' => 'string', 'require' => true, 'desc' => '商品类别图'),
                'description'=> array('name' => 'description', 'require' => true, 'desc' => '类别描述'),
                'parent_id'=> array('name' => 'parent_id','require' => true, 'desc' => '父id'),
            ),

            'update'=> array(
                'product_type_id' => array('name' => 'product_type_id', 'type' =>'string', 'require' => true,'desc' => '商品类别id'),
                'name' => array('name' => 'name', 'type' => 'string', 'require' => true, 'desc' => '商品类别名称'),
                'image_url'=> array('name' => 'image_url',  'type' => 'string', 'require' => true, 'desc' => '商品类别图'),
                'description'=> array('name' => 'description', 'require' => true, 'desc' => '类别描述'),
                'parent_id'=> array('name' => 'parent_id','require' => true, 'desc' => '父id'),
            ),
            'deleteById' => array(
                'product_type_id' => array('name' => 'product_type_id', 'type' =>'string', 'require' => true,'desc' => '商品类别id'),
            ),
            'getSelect' => array(
            ),

        );
    }


    /**
     * 商品类别信息列表
     * @desc  获取商品类别信息列表
     */
    public function getList(){

        $rs = array('code' => 0, 'msg' => '', 'info' => array());

        $productType = new Domain_ProductType();

        $result = $productType->getList($this);

        if(is_array($result)){

            $rs['code'] = 1;

            $rs['info'] = $result;
        }

        return $rs;

    }

    /**
     * 获取选择框数据
     */
    public function getSelect(){

        $rs = array('code' => 0, 'msg' => '', 'info' => array());

        $productType = new Domain_ProductType();

        $result = $productType->getSelect();

        if(is_array($result)){

            $rs['code'] = 1;

            $rs['info'] = $result;
        }

        return $rs;
    }

    /**
     * 新增商品类别
     * @desc  新增商品类别
     */
    public function insert(){

        $rs = array('code' => 0, 'msg' => '', 'info' => array());

        $productType = new Domain_ProductType();

        $result = $productType->insert($this);

        if($result){

            $rs['code'] = 1;

            $rs['info'] = $result;
        }

        return $rs;

    }

    /**
     * 修改商品类别
     * @desc  修改商品类别
     */
    public function update(){

        $rs = array('code' => 0, 'msg' => '', 'info' => array());

        $productType = new Domain_ProductType();

        $result = $productType->update($this);

        if($result){

            $rs['code'] = 1;

            $rs['info'] = $result;
        }

        return $rs;

    }


    /**
     * 删除商品类别信息
     */
    public function deleteById(){

        $rs = array('code' => 0, 'msg' => '', 'info' => array());

        $domain = new Domain_ProductType();

        $result = $domain->deleteById($this);

        if($result){

            $rs['code'] = 1;

            $rs['info'] = $result;
        }

        return $rs;
    }

}