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
        $arr=array();

        $name=$data->commodity_name;

        $datestart=$data->datestart;

        $dateend=$data->dateend;




          //获取所有商品信息
          $commodity=DI()->notorm->commodity->fetchAll();
          //循环商品获取每个商品对应的全部订单信息
          for($i=0;$i<count($commodity);$i++){
              $select = DI()->notorm->commodity_order;

              if ('undefined' !== $name && '' !== $name && null !== $name) {

                  $select = $select->where('commodity_name', $name);
              }

              if ('undefined' !== $datestart && '' !== $datestart && null !== $datestart) {
                  //select fullName,addedTime FROM t_user where addedTime between  '2017-1-1 00:00:00'  and '2018-1-1 00:00:00';
                  $select = $select->where('updatedAt >= ?',$datestart);

              }

              if ('undefined' !== $dateend && '' !== $dateend && null !== $dateend) {
                  //select fullName,addedTime FROM t_user where addedTime between  '2017-1-1 00:00:00'  and '2018-1-1 00:00:00';
                  $select = $select->where('updatedAt < ?',$dateend);

              }


              //获取该商品id下的全部订单信息
              $commodity_order=$select->where(array('product_id'=>$commodity[$i]['id'],'pay'=>'1'))->fetchAll();

              if($commodity_order){
                  $list=array();
                  //获取到商品名称
                  $list['commodity_name']=$commodity[$i]['name'];
                  //获取到订单数量
                  $list['order_num']=count($commodity_order);
                  //获取到该商品总数和金额总计
                  $commodity_num=0;
                  //金额总计
                  $price=0;
                  for ($x=0;$x<count($commodity_order);$x++){
                      $commodity_num+=$commodity_order[$x]['commodity_num'];
                      $price+=$commodity_order[$x]['commodity_num']*$commodity_order[$x]['commodity_price'];
                  }

                  $list['commodity_num']=$commodity_num;
                  //金额总计
                  $list['orders_price']=$price;

                  $arr[]=$list;
              }


          }




        return $arr;

    }

}