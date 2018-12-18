<?php

include_once '../../Config/app.php';
class Model_ProductType extends PhalApi_Model_NotORM
{

    //获取全部商品类别信息
    public function getList($data){

        $name='';

        if('undefined' !== $data->name && '' !== $data->name && null !== $data->name ) {

            $name = $data->name;

            $res=DI()->notorm->product_type->select('*,product_type_id as `key`')->where('name LIKE ? ','%'.$name.'%')->order('product_type_id')->fetchAll();
        }else{

            $res=DI()->notorm->product_type->select('*,product_type_id as `key`')->fetchAll();
        }
        return $res;
    }

    //获取全部选择框数据
    public function getSelect(){

        $res=DI()->notorm->product_type->select('product_type_id as value,name as label,parent_id,product_type_id,type_parent')
            ->fetchAll();

        return $res;
    }

    public function  getSelectTwo(){

        $sql= 'SELECT product_type_id as value,name as label,parent_id,product_type_id,type_parent  FROM shop_product_type WHERE parent_id IN '.
             ' ( SELECT product_type_id FROM shop_product_type WHERE parent_id = 0) '.
             'UNION SELECT product_type_id as value,name as label,parent_id,product_type_id,type_parent FROM shop_product_type WHERE parent_id = 0 ';

        return DI()->notorm->product_type->queryAll($sql);
    }

    //通过parent_id查询商品类别
    public function findTypeByParentId($parentId){
        return DI()->notorm->product_type->where('parent_id',$parentId)->order('product_type_id')->fetchAll();
    }

    public function insertProductType($data){

        $parentIds=json_decode($data->parent_id);

        if(count($parentIds)>0){
            $parent_id=$parentIds[count($parentIds)-1];
        }

        $info=array(
            'name' => $data->name,
            'image_url' => $data->image_url,
            'description' => $data->description,
            'create_time' => date("Y-m-d H:i:s"),
            'type_parent' => json_encode($parentIds),
            'parent_id' => $parent_id,
        );
        $result=DI()->notorm->product_type->insert($info);

        return $result;
    }


    public function updateProductType($data){

        $parentIds=json_decode($data->parent_id);

        if(count($parentIds)>0){
            $parent_id=$parentIds[count($parentIds)-1];
        }

        $info=array(
            'name' => $data->name,
            'image_url' => $data->image_url,
            'description' => $data->description,
            'type_parent' => json_encode($parentIds),
            'parent_id' => $parent_id,
        );
        $result=DI()->notorm->product_type->where('product_type_id',$data->product_type_id)->update($info);

        return $result;
    }


    public function deleteById($id){

        return DI()->notorm->product_type->where('product_type_id',$id)->delete();
    }


}