<?php
/**
 * 代理返现
 * Created by PhpStorm.
 * User: ${zhouyuan}
 * Date: 2018/10/19
 * Time: 10:45
 */



class Api_AgentCashback extends PhalApi_Api {
    public function getRules() {
        return array(
            'getMemberList' => array(
                'name' => array('name' => 'name', 'type' => 'string', 'require' => false, 'desc' => '姓名'),
                'phone' => array('name' => 'phone', 'type' => 'string', 'require' => false, 'desc' => '手机号码'),
                'authorization_number' => array('name' => 'authorization_number', 'type' => 'string', 'require' => false, 'desc' => '代理授权编号'),
                'pageSize'=> array('name' => 'pageSize',  'type' => 'int', 'require' => true, 'desc' => '每页条数'),
                'pageIndex'=> array('name' => 'pageIndex', 'type' => 'int', 'require' => true,  'desc' => '跳转页码'),
                ),
            'getMemberListMsg' => array(
                'id' => array('name' => 'id', 'type' => 'string', 'require' => true, 'desc' => '代理商id'),
                'pageSize'=> array('name' => 'pageSize',  'type' => 'int', 'require' => true, 'desc' => '每页条数'),
                'pageIndex'=> array('name' => 'pageIndex', 'type' => 'int', 'require' => true,  'desc' => '跳转页码'),
                'status' => array('name' => 'status', 'type' => 'string', 'require' => false, 'desc' => '返现状态'),
            ),
            'getAgentCashbackList'=>array(
                'id' => array('name' => 'id', 'type' => 'string', 'require' => true, 'desc' => '代理商id'),
                'pageSize'=> array('name' => 'pageSize',  'type' => 'int', 'require' => true, 'desc' => '每页条数'),
                'pageIndex'=> array('name' => 'pageIndex', 'type' => 'int', 'require' => true,  'desc' => '跳转页码'),
                'member_name' => array('name' => 'member_name', 'type' => 'string', 'require' => false, 'desc' => '会员姓名(下级)'),
                'record_date' => array('name' => 'record_date', 'type' => 'string', 'require' => false, 'desc' => '记录时间'),
            ),
            'getAgentCashbackMonthList'=>array(
                'id' => array('name' => 'id', 'type' => 'string', 'require' => true, 'desc' => '代理商id'),
                'month' => array('name' => 'month', 'type' => 'string', 'require' => true, 'desc' => '当月月份'),
                'pageSize'=> array('name' => 'pageSize',  'type' => 'int', 'require' => true, 'desc' => '每页条数'),
                'pageIndex'=> array('name' => 'pageIndex', 'type' => 'int', 'require' => true,  'desc' => '跳转页码'),
                'member_name' => array('name' => 'member_name', 'type' => 'string', 'require' => false, 'desc' => '会员姓名(下级)'),
                'record_date' => array('name' => 'record_date', 'type' => 'string', 'require' => false, 'desc' => '记录时间'),
            ),
             'updateCashStatus'=>array(
            'id' => array('name' => 'id', 'type' => 'string', 'require' => true, 'desc' => '月记录信息id'),
            'operation' => array('name' => 'operation', 'type' => 'string', 'require' => true,'desc' => '操作人')
            )
        );
    }

    /**
     * 获取会员信息列表（代理商）
     * @desc 获取会员信息列表（代理商）
     * @return int code 操作码，1表示成功， 0表示失败 2 表示验证失败
     * @return string msg 提示信息
     */

    public function getMemberList(){
        $rs = array('code' => 1, 'msg' => '','list'=>[]);

        $domain = new Domain_AgentCashback();
        $rel=$domain->getMemberList($this);


        $rs['list']=$rel;

        return $rs;

    }
 /**
  * 获取代理返现明细列表详情
  */
 public function  getAgentCashbackList(){
     $rs = array('code' => 1, 'msg' => '','list'=>[]);

     $domain = new Domain_AgentCashback();
     $rel=$domain->getAgentCashbackList($this);


     $rs['list']=$rel;

     return $rs;

 }
    /**
     * 获取代理月返现明细列表详情
     */
    public function  getAgentCashbackMonthList(){
        $rs = array('code' => 1, 'msg' => '','list'=>[]);

        $domain = new Domain_AgentCashback();
        $rel=$domain->getAgentCashbackMonthList($this);


        $rs['list']=$rel;

        return $rs;

    }
    /**
     * 获取会员返现当月返现统计信息
     */
    public function  getMemberListMsg(){
        $rs = array('code' => 1, 'msg' => '','list'=>[]);

        $domain = new Domain_AgentCashback();
        $rel=$domain->getMemberListMsg($this);


        $rs['list']=$rel;

        return $rs;

    }
   /**
    * 修改会员返现当月统计信息表中返现状态
    */
   public  function updateCashStatus(){
       $rs = array('code' => 1, 'msg' => '','list'=>[]);

       $domain = new Domain_AgentCashback();
       $rel=$domain->updateCashStatus($this);


       $rs['res']=$rel;

       return $rs;
   }

}