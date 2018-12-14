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

    //通过parent_id查询商品类别
    public function findTypeByParentId($parentId){
        return DI()->notorm->product_type->where('parent_id',$parentId)->order('id')->fetchAll();
    }

    public function insertProduct($data){

        try{
            $info=array(
                'name' => $data->name,
                'first_picture' => $data->first_picture,
                'detail' => $data->detail,
                'create_time' => date("Y-m-d H:i:s"),
                'brand' => $data->brand,
                'intro' => $data->intro,
                'market_price' => $data->market_price,
                'agent_price' => $data->agent_price,
                'num' => 0,//默认库存数为0
            );
            $result=DI()->notorm->commodity->insert($info);

            $banners=json_decode($data->banners);

            if(count($banners)>0){
                $rows=array();
                for ($i=0;$i<count($banners);$i++){

                    $rows[$i]['path'] = $banners[$i];

                    $rows[$i]['is_use'] = '2';//是否使用(0未使用,1已使用)

                    $rows[$i]['product_id'] = $result['id'];

                    $rows[$i]['create_time'] = date("Y-m-d H:i:s");
                }
                $rs = DI()->notorm->banner->insert_multi($rows);
            }

            return true;

        }catch (Exception $e){
            return false;
        }
    }


    public function updateProduct($data){

        try{

            $info=array(
                'name' => $data->name,
                'first_picture' => $data->first_picture,
                'detail' => $data->detail,
                'brand' => $data->brand,
                'intro' => $data->intro,
                'market_price' => $data->market_price,
                'agent_price' => $data->agent_price,
            );
            //Step 1: 开启事务
            DI()->notorm->beginTransaction('db_daili');
            //修改商品类别表
            DI()->notorm->commodity->where('id', $data->id)->update($info);

            //删除banner表中相关数据
            DI()->notorm->banner->where('product_id', $data->id)->delete();

            //插入banner表
            $banners=json_decode($data->banners);

            if(count($banners)>0){
                $rows=array();
                for ($i=0;$i<count($banners);$i++){

                    $rows[$i]['path'] = $banners[$i];

                    $rows[$i]['is_use'] = '2';//是否使用(0未使用,1已使用)

                    $rows[$i]['product_id'] = $data->id;

                    $rows[$i]['create_time'] = date("Y-m-d H:i:s");
                }
                $rs = DI()->notorm->banner->insert_multi($rows);
            }

            //Step 3: 提交事务
            DI()->notorm->commit('db_daili');

            return true;

        }catch (Exception $e){

            DI()->logger->log('updateProduct','商品类别修改失败',$e);

            DI()->notorm->rollback('db_daili'); // 回滚

            return false;
        }
    }

    public function getById($id){

        $result=DI()->notorm->commodity->where('id',$id) -> fetchOne();

        $bannerAll=DI()->notorm->banner->where('product_id',$id) -> fetchAll();

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
            DI()->notorm->commodity->where('id', $id)->delete();

            //删除
            DI()->notorm->banner->where('product_id', $id)->delete();

            return "success";

        }catch (Exception $e){

            DI()->logger->log('deleteProduct','删除商品类别id:'.$id,$e);

            return "error";
        }
    }

    public function getMemberLevelList(){

        try{

            return DI()->notorm->members_level->fetchAll();

        }catch (Exception $e){

            DI()->logger->log('findmemberlevel','查看会员等级',$e);

            return false;
        }


    }


}