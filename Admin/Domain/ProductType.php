<?php

/**
 * Created by PhpStorm.
 * User: lxl
 * Date: 2018/7/17
 * Time: 下午3:37
 */
class Domain_ProductType
{

    public function getList($data){

        try{

            $productType = new Model_ProductType();

            $res=$productType ->getList($data);

            if(count($res)>0){

                $res=$this->getTree($res,0);
            }
            return $res;

        }catch (Exception $e){

            DI()->logger->error('获取商品类别列表失败','异常信息:'.$e);

            return false;
        }
    }

    public function getSelect(){

        try{

            $productType = new Model_ProductType();

            $res=$productType ->getSelectTwo();

            if(count($res)>0) {

                $res = $this->getTree($res, 0);
            }
            $none=array('value'=>0,'label'=>'无','parent_id'=>'0');

            array_unshift($res,$none);

            return $res;

        }catch (Exception $e){

            DI()->logger->error('获取选择框数据失败','异常信息:'.$e);

            return false;
        }
    }

    public function insert($data){

        try{

            $product = new Model_ProductType();

            return $product ->insertProductType($data);

        }catch (Exception $e){

            DI()->logger->error('商品类别新增失败','异常信息:'.$e);

            return false;
        }
    }

    public function update($data){

        try{

            $product = new Model_ProductType();

            $product ->updateProductType($data);

            return true;

        }catch (Exception $e){

            DI()->logger->error('修改商品类别失败','异常信息:'.$e);

            return false;
        }
    }

    public function deleteById($data){

        try{

            $this->deleteTree($data->product_type_id);

            return true;

        }catch (Exception $e){

            DI()->logger->error('删除商品类别失败','异常信息:'.$e);

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
            $v['type_parent']=json_decode ($v['type_parent']);
            if($v['parent_id'] == $pId)
            {        //父亲找到儿子
                $v['children'] = $this->getTree($data, $v['product_type_id']);
                $tree[] = $v;
            }
        }
        return $tree;
    }

    //删除树节点及其子节点(根据标识id)
    public function deleteTree($id){

        $model=new Model_ProductType();

        $model->deleteById($id);

        $types=$model->findTypeByParentId($id);

        foreach ($types as $type){

            $product_type_id = $type['product_type_id'];

            $this->deleteTree($product_type_id);
        }

    }

    public function getSelectAll(){

        try{

            $productType = new Model_ProductType();

            $res=$productType ->getSelect();

            if(count($res)>0) {

                $res = $this->getTree($res, 0);
            }

            return $res;

        }catch (Exception $e){

            DI()->logger->error('获取全部选择框数据失败','异常信息:'.$e);

            return false;
        }
    }



}