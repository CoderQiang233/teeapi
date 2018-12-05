<?php

/**
 * Created by PhpStorm.
 * User: lxl
 * Date: 2018/7/17
 * Time: 下午3:38
 */
include_once '../../Config/app.php';
class Model_Inventory extends PhalApi_Model_NotORM
{

    public function editTotalInventory($data){

        try{
            //现在库存=原有库存+改变的库存
            $now_inventory=$data->num+$data->change_inventory;

            $info=array(
                'product_id' => $data->product_id,//商品id
                'member_id' => $data->member_id,//会员id
                'name' => $data->name,//会员真实姓名
                'state' => '2',//出库，入库(1出库   2入库)
                'date_added' => date("Y-m-d H:i:s"),//创建时间
                'before_inventory' => $data->num,//出入库前库存
                'change_inventory' => $data->change_inventory,//改变的库存(出入库数量)
                'now_inventory' => $now_inventory,//现在库存
                'total_state' => '1',//总部, 代理(1总部   2代理)
                'userName' => $data->userName,//操作人用户号
                'user_name' => $data->user_name,//操作人真实姓名
                'remark' => '添加总库存',//备注
            );
            //1.修改商品表的总库存
            $result=DI()->notorm->commodity->where('id', $data->product_id)->update(array('num' => $now_inventory));
            //2.插入库存记录表
            if($result){
                $rs=DI()->notorm->inventory_record->insert($info);
            }

            return true;

        }catch (Exception $e){

            DI()->logger->log('editTotalInventory','添加总库存',$e);

            return false;
        }
    }

    /**
     * @param $data
     * @return array|bool
     * 查看总部的库存明细
     */
    public function getInventoryRecordTotal($data){

        try{

            $where='';

            $pageSize='';//每页条数

            $pageIndex='';//当前页

            $state='';//出入库(1出库   2入库)

            if('undefined' !== $data->pageSize && '' !== $data->pageSize && null !== $data->pageSize ){

                $pageSize=$data->pageSize;

            }

            if('undefined' !== $data->pageIndex && '' !== $data->pageIndex && null !== $data->pageIndex ){

                $pageIndex=$data->pageIndex;

            }
            $start_page=$pageSize*($pageIndex-1);

            if('undefined' !== $data->state && '' !== $data->state && null !== $data->state ) {

                $state = $data->state;

                $where=$where." AND r.state='".$state."'";
            }

            $params = array(':pageSize' => $pageSize,':start_page' => $start_page,':product_id' => $data->product_id);

            $sql = 'SELECT r.*,c.name as product_name '
                . 'FROM inventory_record AS r LEFT JOIN commodity AS c '
                . 'ON r.product_id=c.id WHERE r.product_id=:product_id and r.total_state=1 '
                . $where
                .' order by r.id desc  limit :start_page,:pageSize ';

            $sqls = 'SELECT r.*,c.name as product_name '
                . 'FROM inventory_record AS r LEFT JOIN commodity AS c '
                . 'ON r.product_id=c.id WHERE r.product_id=:product_id and r.total_state=1 '
                . $where;

            $recordTotal= DI()->notorm->inventory_record->queryAll($sql,$params);

            $total = count(DI()->notorm->inventory_record->queryAll($sqls,$params));

            return array(
                'recordTotal' => $recordTotal,
                'total' => $total,
                'pageIndex' => $pageIndex,
            );
        }catch (Exception $e){

            DI()->logger->log('getInventoryRecordTotal','查看总的库存明细失败',$e);

            return false;
        }
    }

    /**
     * @param $data
     * @return array|bool
     * 查看代理库存
     */
    public function getInventoryAgent($data){

        try{

            $where='';

            $pageSize='';//每页条数

            $pageIndex='';//当前页

            $name='';//会员真实姓名

            $product_name='';//商品名称

            if('undefined' !== $data->pageSize && '' !== $data->pageSize && null !== $data->pageSize ){

                $pageSize=$data->pageSize;

            }

            if('undefined' !== $data->pageIndex && '' !== $data->pageIndex && null !== $data->pageIndex ){

                $pageIndex=$data->pageIndex;

            }
            $start_page=$pageSize*($pageIndex-1);

            if('undefined' !== $data->name && '' !== $data->name && null !== $data->name ) {

                $name = $data->name;

                $where=$where." AND r.name like '%".$name."%'";
            }

            if('undefined' !== $data->product_name && '' !== $data->product_name && null !== $data->product_name ) {

                $product_name = $data->product_name;

                $where=$where." AND c.name like '%".$product_name."%'";
            }

            if('undefined' !== $data->product_id && '' !== $data->product_id && null !== $data->product_id ) {

                $product_id = $data->product_id;

                $where=$where." AND r.product_id = ".$product_id;
            }

            $params = array(':pageSize' => $pageSize,':start_page' => $start_page);

            $sql = 'SELECT r.*,c.name as product_name,c.first_picture '
                . 'FROM agent_inventory AS r LEFT JOIN commodity AS c '
                . 'ON r.product_id=c.id WHERE 1=1 '
                . $where
                .' order by r.id desc  limit :start_page,:pageSize ';

            $sqls = 'SELECT r.*,c.name as product_name,c.first_picture '
                . 'FROM agent_inventory AS r LEFT JOIN commodity AS c '
                . 'ON r.product_id=c.id WHERE 1=1 '
                . $where;

            $agentInventory= DI()->notorm->agent_inventory->queryAll($sql,$params);

            $total = count(DI()->notorm->agent_inventory->queryAll($sqls,$params));

            return array(
                'agentInventory' => $agentInventory,
                'total' => $total,
                'pageIndex' => $pageIndex,
            );
        }catch (Exception $e){

            DI()->logger->log('getInventoryAgent','查看代理库存失败',$e);

            return false;
        }
    }


    /**
     * @param $data
     * @return array|bool
     * 查看代理单个商品库存明细
     */
    public function getAgentProductRecord($data){

        try{

            $where='';

            $pageSize='';//每页条数

            $pageIndex='';//当前页

            $state='';//出入库(1出库   2入库)

            if('undefined' !== $data->pageSize && '' !== $data->pageSize && null !== $data->pageSize ){

                $pageSize=$data->pageSize;

            }

            if('undefined' !== $data->pageIndex && '' !== $data->pageIndex && null !== $data->pageIndex ){

                $pageIndex=$data->pageIndex;

            }
            $start_page=$pageSize*($pageIndex-1);

            if('undefined' !== $data->state && '' !== $data->state && null !== $data->state ) {

                $state = $data->state;

                $where=$where." AND r.state='".$state."'";
            }

            $params = array(':pageSize' => $pageSize,':start_page' => $start_page,
                ':product_id' => $data->product_id,':member_id' => $data->member_id);

            $sql = 'SELECT r.*,c.name as product_name '
                . 'FROM inventory_record AS r LEFT JOIN commodity AS c '
                . 'ON r.product_id=c.id WHERE r.product_id=:product_id and r.member_id=:member_id and r.total_state=2 '
                . $where
                .' order by r.id desc  limit :start_page,:pageSize ';

            $sqls = 'SELECT r.*,c.name as product_name '
                . 'FROM inventory_record AS r LEFT JOIN commodity AS c '
                . 'ON r.product_id=c.id WHERE r.product_id=:product_id and r.member_id=:member_id and r.total_state=2 '
                . $where;

            $recordAgentProduct= DI()->notorm->inventory_record->queryAll($sql,$params);

            $total = count(DI()->notorm->inventory_record->queryAll($sqls,$params));

            return array(
                'recordAgentProduct' => $recordAgentProduct,
                'total' => $total,
                'pageIndex' => $pageIndex,
            );
        }catch (Exception $e){

            DI()->logger->log('getAgentProductRecord','查看代理单个商品库存明细',$e);

            return false;
        }
    }







}