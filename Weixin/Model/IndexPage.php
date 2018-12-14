<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/12/12
 * Time: 14:02
 */
class Model_IndexPage extends PhalApi_Model_NotORM{
    public function getBanner(){
        $data=DI()->notorm->banner->select('*')->order('id DESC')->fetchAll();
        return $data;
    }

    public  function search($name)
    {

        return DI()->notorm->product->where('name LIKE ?', '%' . $name . '%')->order('market_price')->fetchAll();
    }
    public function getModules(){
        $sql = 'SELECT * FROM shop_index_layout l LEFT JOIN shop_module m ON l.module_id=m.id ORDER BY l.sort_order';

        $rows =$this->getORM()->queryAll($sql);
        return $rows;
    }

    public function getProduct($id){
        $data=DI()->notorm->product->select('product_id','name','first_picture','market_price','intro')->where('product_id',$id)->fetchOne();
        return $data;
    }
}