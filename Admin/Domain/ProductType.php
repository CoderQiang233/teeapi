<?php

/**
 * Created by PhpStorm.
 * User: lxl
 * Date: 2018/7/17
 * Time: 下午3:37
 */
class Domain_ProductType
{
    public function searchProduct($keyword){
        $product = new Model_Product();

        return $product ->searchProduct($keyword);
    }



    public function getList($data){

        try{

            $productType = new Model_ProductType();

            $res=$productType ->getList($data);

            $re=$this->getTree($res,0);

            return $re;

        }catch (Exception $e){

            DI()->logger->error('获取商品类别列表失败','异常信息:'.$e);

            return false;
        }
    }

    /**
     * @param $data 查询的所有类别数据
     * @param $pId  初始的parent_id
     * @return array|string
     */
    function getTree($data, $pId)
    {
        $tree = '';
        foreach($data as $k => $v)
        {
            if($v['parent_id'] == $pId)
            {        //父亲找到儿子
                $v['children'] = $this->getTree($data, $v['product_type_id']);
                $tree[] = $v;
            }
        }
        return $tree;
    }


    public function insert($data){

        $product = new Model_Product();

        return $product ->insertProduct($data);
    }

    public function update($data){

        $product = new Model_Product();

        return $product ->updateProduct($data);
    }

    public function getById($id){

        $model = new Model_Product();

        return $model->getById($id);

    }

    public function deleteById($id){

        $model = new Model_Product();

        return $model->deleteById($id);

    }


    public function getMemberLevelList(){

        $product = new Model_Product();

        return $product ->getMemberLevelList();
    }



}