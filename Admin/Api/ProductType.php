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
            'getById' => array(
                'id' 	=> array('name' => 'id', 'type' =>'string', 'require' => true)
            ),
            'insert'=> array(
                'name' => array('name' => 'name', 'type' => 'string', 'require' => true, 'desc' => '商品类别名称'),
                'first_picture'=> array('name' => 'first_picture',  'type' => 'string', 'require' => true, 'desc' => '商品类别首图'),
                'banners'=> array('name' => 'banners', 'desc' => 'banner图'),
                'detail'=> array('name' => 'detail',  'desc' => '详情'),
                'brand'=> array('name' => 'brand', 'desc' => '商品类别品牌'),
                'intro'=> array('name' => 'intro',  'desc' => '商品类别简介'),
                'market_price'=> array('name' => 'market_price','require' => true, 'desc' => '市场价格'),
                'agent_price'=> array('name' => 'agent_price', 'require' => true, 'desc' => '代理价格'),
            ),

            'update'=> array(
                'id' 	=> array('name' => 'id', 'type' =>'string', 'require' => true,'desc' => '商品类别id'),
                'name' => array('name' => 'name', 'type' => 'string', 'require' => true, 'desc' => '商品类别名称'),
                'first_picture'=> array('name' => 'first_picture',  'type' => 'string', 'require' => true, 'desc' => '商品类别首图'),
                'banners'=> array('name' => 'banners', 'desc' => 'banner图'),
                'detail'=> array('name' => 'detail',  'desc' => '详情'),
                'brand'=> array('name' => 'brand', 'desc' => '商品类别品牌'),
                'intro'=> array('name' => 'intro',  'desc' => '商品类别简介'),
                'market_price'=> array('name' => 'market_price','require' => true, 'desc' => '市场价格'),
                'agent_price'=> array('name' => 'agent_price', 'require' => true, 'desc' => '代理价格'),
            ),
            'deleteById' => array(
                'id' 	=> array('name' => 'id', 'type' =>'string', 'require' => true)
            ),

            'getMemberLevelList' => array(
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
     * 新增商品类别
     * @desc  新增商品类别
     */
    public function insert(){

        $rs = array('code' => 0, 'msg' => '', 'info' => array());

        $product = new Domain_Product();

        $result = $product->insert($this);

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

        $product = new Domain_Product();

        $result = $product->update($this);

        if($result){

            $rs['code'] = 1;

            $rs['info'] = $result;
        }

        return $rs;

    }

    /**
     * 单个商品类别信息
     */
    public function getById(){

        $rs = array('code' => 0, 'msg' => '', 'info' => array());

        $id = $this ->id;

        $domain = new Domain_Product();

        $result = $domain->getById($id);

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

        $id = $this ->id;

        $domain = new Domain_Product();

        $result = $domain->deleteById($id);

        if($result=="success"){

            $rs['code'] = 1;

            $rs['info'] = $result;
        }

        return $rs;
    }


    /**
     * 会员等级信息列表
     * @desc  会员等级信息列表
     */
    public function getMemberLevelList(){

        $rs = array('code' => 0, 'msg' => '', 'info' => array());

        $product = new Domain_Product();

        $result = $product->getMemberLevelList();

        if($result){

            $rs['code'] = 1;

            $rs['info'] = $result;
        }

        return $rs;

    }




}