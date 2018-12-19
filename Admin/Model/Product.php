<?php

/**
 * Created by PhpStorm.
 * User: lxl
 * Date: 2018/7/17
 * Time: 下午3:38
 */
include_once '../../Config/app.php';
class Model_Product extends PhalApi_Model_NotORM
{
 public function searchProduct($keyword){
     $products=DI()->notorm->product->select('product_id','name')->where(array('name LIKE ? '=> '%'.$keyword.'%','status'=>1))->order('name DESC')->fetchAll();
     return $products;
 }
    //获取商品列表
    public function getList($data){

        $pageSize='';//每页条数

        $pageIndex='';//当前页

        $name='';

        $where='';

        if('undefined' !== $data->pageSize && '' !== $data->pageSize && null !== $data->pageSize ){

            $pageSize=$data->pageSize;
        }

        if('undefined' !== $data->pageIndex && '' !== $data->pageIndex && null !== $data->pageIndex ){

            $pageIndex=$data->pageIndex;
        }

        if('undefined' !== $data->name && '' !== $data->name && null !== $data->name ){

            $name=$data->name;

            $where=$where." AND p.name like '%".$name."%'";
        }

        $start_page=$pageSize*($pageIndex-1);

        $params = array(':pageSize' => $pageSize,':start_page' => $start_page);

        $sql = 'SELECT p.*,t.name as type_name '
            . 'FROM shop_product AS p LEFT JOIN shop_product_type AS t '
            . 'ON p.product_type_id=t.product_type_id WHERE 1=1  '
            . $where
            .' order by p.product_id desc  limit :start_page,:pageSize ';

        $sqls = 'SELECT p.*,t.name as type_name '
            . 'FROM shop_product AS p LEFT JOIN shop_product_type AS t '
            . 'ON p.product_type_id=t.product_type_id WHERE 1=1  '
            . $where;

        $products= DI()->notorm->product->queryAll($sql,$params);

        $imgUrl=DI()->config->get('app.imagePath');

        for ($i=0;$i<count($products);$i++){
            $product=$products[$i];
            $bannerAll=DI()->notorm->product_banner->select('banner_id as uid,path as url')->where('product_id',$product['product_id']) -> fetchAll();
            if(count($bannerAll)>0){
                for($j=0;$j<count($bannerAll);$j++){
                    $bannerAll[$j]['url']=$imgUrl.$bannerAll[$j]['url'];
                }
                $products[$i]['banners']=$bannerAll;
            }
        }

        $total = count(DI()->notorm->product->queryAll($sqls));

        return array(
            'products' => $products,
            'total' => $total,
            'pageIndex' => $pageIndex,
        );
    }

    public function insertProduct($data){

        try{

            $typeIds=json_decode($data->product_type_id);

            if(count($typeIds)>0){
                $product_type_id=$typeIds[count($typeIds)-1];
            }

            $info=array(
                'name' => $data->name,
                'first_picture' => $data->first_picture,
                'detail' => $data->detail,
                'create_time' => date("Y-m-d H:i:s"),
                'brand' => $data->brand,
                'intro' => $data->intro,
                'market_price' => $data->market_price,
                'brokerage' => $data->brokerage,
                'num' => 0,//默认库存数为0
                'product_type_id' => $product_type_id,
                'type_parent' => json_encode($typeIds),
                'status' => 1,//上下架(1:上架,2:下架)
            );
            $result=DI()->notorm->product->insert($info);

            $banners=json_decode($data->banners);

            if(count($banners)>0){
                $rows=array();
                for ($i=0;$i<count($banners);$i++){

                    $rows[$i]['path'] = $banners[$i];

                    $rows[$i]['product_id'] = $result['id'];

                    $rows[$i]['create_time'] = date("Y-m-d H:i:s");
                }
                $rs = DI()->notorm->product_banner->insert_multi($rows);
            }

            return true;

        }catch (Exception $e){

            DI()->logger->error('新增商品失败','异常信息:'.$e);

            return false;
        }
    }


    public function updateProduct($data){

        try{

            $typeIds=json_decode($data->product_type_id);

            if(count($typeIds)>0){
                $product_type_id=$typeIds[count($typeIds)-1];
            }

            $info=array(
                'name' => $data->name,
                'first_picture' => $data->first_picture,
                'detail' => $data->detail,
                'brand' => $data->brand,
                'intro' => $data->intro,
                'market_price' => $data->market_price,
                'brokerage' => $data->brokerage,
                'product_type_id' => $product_type_id,
                'type_parent' => json_encode($typeIds),
            );
            //Step 1: 开启事务
            DI()->notorm->beginTransaction('db_teeshop');
            //修改商品表
            DI()->notorm->product->where('product_id', $data->id)->update($info);

            //删除banner表中相关数据
            DI()->notorm->product_banner->where('product_id', $data->id)->delete();

            //插入banner表
            $banners=json_decode($data->banners);

            if(count($banners)>0){
                $rows=array();
                for ($i=0;$i<count($banners);$i++){

                    $rows[$i]['path'] = $banners[$i];

                    $rows[$i]['product_id'] = $data->id;

                    $rows[$i]['create_time'] = date("Y-m-d H:i:s");
                }
                $rs = DI()->notorm->product_banner->insert_multi($rows);
            }

            //Step 3: 提交事务
            DI()->notorm->commit('db_teeshop');

            return true;

        }catch (Exception $e){

            DI()->logger->log('updateProduct','商品修改失败',$e);

            DI()->notorm->rollback('db_teeshop'); // 回滚

            return false;
        }
    }

    public function getById($id){

        $result=DI()->notorm->product->where('product_id',$id) -> fetchOne();

        $bannerAll=DI()->notorm->product_banner->where('product_id',$id) -> fetchAll();

        $banners=array();

        $imgUrl=DI()->config->get('app.imagePath');

        for($i=0;$i<count($bannerAll);$i++){
            $banners[$i]['uid']=$bannerAll[$i]['id'];
            $banners[$i]['url']=$imgUrl.$bannerAll[$i]['path'];
        }
        $result['banners']=$banners;

        return $result;

    }

    public function deleteById($id){

        try{
            //删除
            DI()->notorm->product->where('product_id', $id)->delete();

            //删除
            DI()->notorm->product_banner->where('product_id', $id)->delete();

            return "success";

        }catch (Exception $e){

            DI()->logger->log('deleteProduct','删除商品id:'.$id,$e);

            return "error";
        }
    }


    public function  productUpDown($data){

     return DI()->notorm->product->where('product_id',$data->id)->update(array('status'=>$data->status));
    }



}