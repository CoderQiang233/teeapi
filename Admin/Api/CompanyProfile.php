<?php
/**
 * 公司简介管理
 * Created by PhpStorm.
 * User: ${zhouyuan}
 * Date: 2018/10/19
 * Time: 15:35
 */


class Api_CompanyProfile  extends PhalApi_Api{


    public function getRules() {
        return array(
            'getlist'=> array(
                'pageSize'=> array('name' => 'pageSize',  'type' => 'int', 'require' => true, 'desc' => '每页条数'),
                'pageIndex'=> array('name' => 'pageIndex', 'type' => 'int', 'require' => true,  'desc' => '跳转页码'),
            ),
            'insert'=> array(
                'title' => array('name' => 'title', 'type' => 'string', 'require' => true, 'desc' => '公司简介标题'),
                'content'=> array('name' => 'content',  'desc' => '公司简介详情'),
            ),
            'deleteById' => array(
                'id' 	=> array('name' => 'id', 'type' =>'string', 'require' => true)
            ),
            'update'=> array(
                'id' 	=> array('name' => 'id', 'type' =>'string', 'require' => true,'desc' => '公司简介id'),
                'title' => array('name' => 'title', 'type' => 'string', 'require' => true, 'desc' => '公司简介标题'),
                'content'=> array('name' => 'content',  'desc' => '公司简介详情'),
            ),
            'change'=> array(
                'id' 	=> array('name' => 'id', 'type' =>'string', 'require' => true,'desc' => '新闻id'),
                'status' => array('name' => 'status', 'type' => 'string', 'require' => true, 'desc' => '新闻状态'),
            ),
        );
    }


    /**
     * 公司简介信息列表
     * @desc  获取公司简介信息列表
     */
    public function getlist(){

        $rs = array('code' => 0, 'msg' => '', 'info' => array());

        $product = new Domain_CompanyProfile();

        $result = $product->getlist($this);

        if($result){

            $rs['code'] = 1;

            $rs['info'] = $result;
        }

        return $rs;

    }

    /**
     * 新增公司简介
     * @desc  新增公司简介
     */
    public function insert(){

        $rs = array('code' => 0, 'msg' => '', 'info' => array());

        $product = new Domain_CompanyProfile();

        $result = $product->insert($this);

        if($result){

            $rs['code'] = 1;

            $rs['info'] = $result;
        }

        return $rs;

    }

    /**
     * 修改公司简介
     * @desc  修改公司简介
     */
    public function update(){

        $rs = array('code' => 0, 'msg' => '', 'info' => array());

        $product = new Domain_CompanyProfile();

        $result = $product->update($this);

        if($result){

            $rs['code'] = 1;

            $rs['info'] = $result;
        }

        return $rs;

    }


    /**
     * 删除公司简介信息
     */
    public function deleteById(){

        $rs = array('code' => 0, 'msg' => '', 'info' => array());

        $id = $this ->id;

        $domain = new Domain_CompanyProfile();

        $result = $domain->deleteById($id);

        if($result=="success"){

            $rs['code'] = 1;

            $rs['info'] = $result;
        }

        return $rs;
    }


    /**
     * 修改公司简介状态
     * @desc  修改公司简介状态
     */
    public function change(){

        $rs = array('code' => 0, 'msg' => '', 'info' => array());

        $product = new Domain_CompanyProfile();

        $result = $product->change($this);

        if($result){

            $rs['code'] = 1;

            $rs['info'] = $result;
        }

        return $rs;

    }


}