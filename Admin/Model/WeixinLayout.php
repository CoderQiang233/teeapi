<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/12/11
 * Time: 15:04
 */
class Model_WeixinLayout extends PhalApi_Model_NotORM{
    public function getModuleList(){
        $sql = 'SELECT * FROM shop_index_layout l LEFT JOIN shop_module m ON l.module_id=m.id ORDER BY l.sort_order';

        $rows =$this->getORM()->queryAll($sql);
        return $rows;
    }
    public function addModule($data){
        $arr=array(
            'name'=>$data->name,
            'setting'=>$data->setting,
            'keyword'=>$data->keyword
        );
        $rs   = DI()->notorm->module->insert($arr);
        $id=$rs['id'];
        $arr=array(
            'module_id'=>$id,
            'sort_order'=>$data->sort_order
        );
        $rs   = DI()->notorm->index_layout->insert($arr);
return $rs;
    }
    public function editModule($data){
        $arr=array(
            'name'=>$data->name,
            'setting'=>$data->setting,
            'keyword'=>$data->keyword
        );
        $rs   = DI()->notorm->module->where('id', $data->id)->update($arr);
        $arr=array(
            'sort_order'=>$data->sort_order
        );
        $rs   = DI()->notorm->index_layout->where('id', $data->id)->update($arr);
        return $rs;
    }
    public function deleteModule($id){
        $rel = DI()->notorm->index_layout->where('module_id', $id)->delete();
        $rel = DI()->notorm->module->where('id', $id)->delete();
return $rel;
    }
    public function getProductOption(){
        $sql = 'SELECT product_id as value ,`name` as text FROM shop_product';

        $rows =$this->getORM()->queryAll($sql);
        return $rows;
    }
}