<?php
/**
 * 代理查询结果反馈
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/10/10 0010
 * Time: 下午 2:16
 *
 */
class Api_DelegateQuery extends PhalApi_Api
{
    public function getRules()
    {
        return array(
            'getOrder_id' => array(
                'order_id' => array('name' => 'order_id', 'type' => 'string', 'require' => true),
            ),
        );
    }

   public function getOrder_id (){

        $rs =array('code' =>0, 'msg'=>'', 'info'=>array());

        $domain =new Domain_DelegateQuery();

        $info =$domain->getBaseInfo($this->order_id);

        if (empty($info)){
            $rs ['code'] =1;
            $rs ['msg'] =T('代理人不存在');

            return $rs;
        }

       if ($info['flag']==1){
           $rs['info'] =$info;

           return $rs;
       }else{
           $rs ['code'] =1;
           $rs ['msg'] =T('无法找到相应的数据');

           return $rs;

       }



   }
}