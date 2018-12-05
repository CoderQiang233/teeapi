<?php
/**
 * 新闻管理列表
 * Created by PhpStorm.
 * User: ${zhouyuan}
 * Date: 2018/10/17
 * Time: 14:49
 */


class Api_News  extends PhalApi_Api{


    public function getRules() {
        return array(
            'getlist'=> array(
                'pageSize'=> array('name' => 'pageSize',  'type' => 'int', 'require' => true, 'desc' => '每页条数'),
                'pageIndex'=> array('name' => 'pageIndex', 'type' => 'int', 'require' => true,  'desc' => '跳转页码'),
            ),
            'insert'=> array(
                'title' => array('name' => 'title', 'type' => 'string', 'require' => true, 'desc' => '新闻标题'),
                'imgurl'=> array('name' => 'imgurl',  'type' => 'string', 'require' => true, 'desc' => '新闻首图'),
                'content'=> array('name' => 'content',  'desc' => '新闻详情'),
            ),

            'update'=> array(
                'id' 	=> array('name' => 'id', 'type' =>'string', 'require' => true,'desc' => '新闻id'),
                'title' => array('name' => 'title', 'type' => 'string', 'require' => true, 'desc' => '新闻标题'),
                'imgurl'=> array('name' => 'imgurl',  'type' => 'string', 'require' => true, 'desc' => '新闻首图'),
                'content'=> array('name' => 'content',  'desc' => '新闻详情'),
            ),
            'deleteById' => array(
                'id' 	=> array('name' => 'id', 'type' =>'string', 'require' => true)
            ),
            'change'=> array(
                'id' 	=> array('name' => 'id', 'type' =>'string', 'require' => true,'desc' => '新闻id'),
                'status' => array('name' => 'status', 'type' => 'string', 'require' => true, 'desc' => '新闻状态'),
            ),
        );
    }


    /**
     * 新闻信息列表
     * @desc  获取新闻信息列表
     */
    public function getlist(){

        $rs = array('code' => 0, 'msg' => '', 'info' => array());

        $product = new Domain_News();

        $result = $product->getlist($this);

        if($result){

            $rs['code'] = 1;

            $rs['info'] = $result;
        }

        return $rs;

    }

    /**
     * 新增新闻
     * @desc  新增新闻
     */
    public function insert(){

        $rs = array('code' => 0, 'msg' => '', 'info' => array());

        $product = new Domain_News();

        $result = $product->insert($this);

        if($result){

            $rs['code'] = 1;

            $rs['info'] = $result;
        }

        return $rs;

    }

    /**
     * 修改新闻信息
     * @desc  修改新闻信息
     */
    public function update(){

        $rs = array('code' => 0, 'msg' => '', 'info' => array());

        $product = new Domain_News();

        $result = $product->update($this);

        if($result){

            $rs['code'] = 1;

            $rs['info'] = $result;
        }

        return $rs;

    }


    /**
     * 删除新闻信息
     */
    public function deleteById(){

        $rs = array('code' => 0, 'msg' => '', 'info' => array());

        $id = $this ->id;

        $domain = new Domain_News();

        $result = $domain->deleteById($id);

        if($result=="success"){

            $rs['code'] = 1;

            $rs['info'] = $result;
        }

        return $rs;
    }


    /**
     * 修改新闻状态
     * @desc  修改新闻状态
     */
    public function change(){

        $rs = array('code' => 0, 'msg' => '', 'info' => array());

        $product = new Domain_News();

        $result = $product->change($this);

        if($result){

            $rs['code'] = 1;

            $rs['info'] = $result;
        }

        return $rs;

    }


}