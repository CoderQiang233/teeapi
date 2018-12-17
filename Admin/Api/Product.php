<?php

/**
 * 管理商品
 *
 * @author: dogstar <chanzonghuang@gmail.com> 2014-10-04
 */
class Api_Product  extends PhalApi_Api{


    public function getRules() {
        return array(
            'getlist'=> array(
                'name' => array('name' => 'name', 'type' => 'string',  'desc' => '商品名称'),
                'pageSize'=> array('name' => 'pageSize',  'type' => 'int', 'require' => true, 'desc' => '每页条数'),
                'pageIndex'=> array('name' => 'pageIndex', 'type' => 'int', 'require' => true,  'desc' => '跳转页码'),
            ),
            'getById' => array(
                'id' 	=> array('name' => 'id', 'type' =>'string', 'require' => true)
            ),
            'insert'=> array(
                'name' => array('name' => 'name', 'type' => 'string', 'require' => true, 'desc' => '商品名称'),
                'first_picture'=> array('name' => 'first_picture',  'type' => 'string', 'require' => true, 'desc' => '商品首图'),
                'banners'=> array('name' => 'banners', 'desc' => 'banner图'),
                'detail'=> array('name' => 'detail',  'desc' => '详情'),
                'brand'=> array('name' => 'brand', 'desc' => '商品品牌'),
                'intro'=> array('name' => 'intro',  'desc' => '商品简介'),
                'market_price'=> array('name' => 'market_price','require' => true, 'desc' => '市场价格'),
                'product_type_id'=> array('name' => 'product_type_id', 'require' => true, 'desc' => '商品类别id'),
                'brokerage'=> array('name' => 'brokerage', 'require' => true, 'desc' => '佣金比率'),

            ),

            'update'=> array(
                'id' 	=> array('name' => 'id', 'type' =>'string', 'require' => true,'desc' => '商品id'),
                'name' => array('name' => 'name', 'type' => 'string', 'require' => true, 'desc' => '商品名称'),
                'first_picture'=> array('name' => 'first_picture',  'type' => 'string', 'require' => true, 'desc' => '商品首图'),
                'banners'=> array('name' => 'banners', 'desc' => 'banner图'),
                'detail'=> array('name' => 'detail',  'desc' => '详情'),
                'brand'=> array('name' => 'brand', 'desc' => '商品品牌'),
                'intro'=> array('name' => 'intro',  'desc' => '商品简介'),
                'market_price'=> array('name' => 'market_price','require' => true, 'desc' => '市场价格'),
                'product_type_id'=> array('name' => 'product_type_id', 'require' => true, 'desc' => '商品类别id'),
                'brokerage'=> array('name' => 'brokerage', 'require' => true, 'desc' => '佣金比率'),
            ),
            'deleteById' => array(
                'id' 	=> array('name' => 'id', 'type' =>'string', 'require' => true,'desc' => '商品id')
            ),
            'productUpDown' => array(
                'id' 	=> array('name' => 'id', 'type' =>'string', 'require' => true,'desc' => '商品id'),
                'status' 	=> array('name' => 'status', 'type' =>'string', 'require' => true,'desc' => '上下架(1:上架,2:下架)')
            ),

            'searchProduct' => array(
                'keyword' => array('name' => 'keyword', 'type' => 'string', 'require' => true, 'desc' => '商品名称'),

            ),
        );
    }

    /**
     * 商品列表模糊搜索
     * @desc  获取商品信息列表
     */
    public function searchProduct(){

        $rs = array('code' => 0, 'msg' => '', 'info' => array());

        $product = new Domain_Product();

        $result = $product->searchProduct($this->keyword);

        if($result){

            $rs['code'] = 1;

            $rs['info'] = $result;
        }

        return $rs;

    }
    /**
     * 商品信息列表
     * @desc  获取商品信息列表
     */
    public function getlist(){

        $rs = array('code' => 0, 'msg' => '', 'info' => array());

        $product = new Domain_Product();

        $result = $product->getlist($this);

        if(is_array($result)){

            $rs['code'] = 1;

            $rs['info'] = $result;
        }

        return $rs;

    }

    /**
     * 新增商品
     * @desc  新增商品
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
     * 修改商品
     * @desc  修改商品
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
     * 单个商品信息
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
     * 删除商品信息
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
     * 商品上下架    上下架(1:上架,2:下架)
     */
    public function productUpDown(){

        $rs = array('code' => 0, 'msg' => '', 'info' => array());

        $product = new Domain_Product();

        $result = $product->productUpDown($this);

        if($result){

            $rs['code'] = 1;

            $rs['info'] = $result;
        }

        return $rs;

    }


}