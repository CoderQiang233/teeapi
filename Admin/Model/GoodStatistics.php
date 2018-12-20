<?php
/**
 * Created by PhpStorm.
 * User: ${zhouyuan}
 * Date: 2018/11/6
 * Time: 11:06
 */

class Model_GoodStatistics extends PhalApi_Model_NotORM
{


    public function getList($data)
    {
        $where='';

        $name='';//商品名称

        $datestart='';//开始时间

        $dateend='';//结束时间

        if('undefined' !==$data->name  && '' !== $data->name && null !== $data->name ){

            $name=$data->name;

            $where=$where." AND op.name like '%".$name."%' ";

            $products=DI()->notorm->product->where('name like ?','%'.$name.'%')->fetchAll();
        }else{
            $products=DI()->notorm->product->fetchAll();
        }

        if('undefined' !==$data->datestart  && '' !== $data->datestart && null !== $data->datestart ){

            $datestart=$data->datestart;

            $where=$where." AND o.updatedAt >='".$datestart."'";
        }

        if('undefined' !==$data->dateend  && '' !== $data->dateend && null !== $data->dateend ){

            $dateend=$data->dateend;

            $where=$where." AND o.updatedAt <='".$dateend."'";
        }

        $sql='SELECT op.`name`,op.product_id,o.updatedAt,o.update_date, sum(op.quantity) as product_num, sum(op.total) as orders_price '
            .'FROM shop_order_product AS op '.
            'LEFT JOIN shop_order AS o ON op.order_id = o.order_id '
            .'where o.pay>:pay and o.`status`=0 and op.product_id=:product_id '
            .$where;
//            .'GROUP BY op.product_id ';

        $res=array();

        foreach ($products as $k => $v){

            $params=array(':pay'=>Common_OrderStatus::ORDER_STATUS_0,':product_id'=>$v['product_id']);

            $info=DI()->notorm->order_product->queryAll($sql,$params);

            if($info[0]['name']){
                $res[]=$info[0];
            }elseif($datestart.$dateend==''){
                $pro=array(
                    'name'=>$v['name'],
                    'product_id'=>$v['product_id'],
                    'updatedAt'=>null,
                    'update_date'=>null,
                    'product_num'=>0,
                    'orders_price'=>0,
                );
                $res[]=$pro;
            }

        }
        return $res;

    }

}