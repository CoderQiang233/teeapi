<?php
/**
 * 返现比例管理
 * Created by PhpStorm.
 * User: ${zhouyuan}
 * Date: 2018/11/9
 * Time: 14:43
 */


class Api_Percentage  extends PhalApi_Api
{


    public function getRules()
    {
        return array(
            'getlist' => array(
            ),
            'insert' => array(
                'level' => array('name' => 'level', 'type' => 'string', 'require' => true, 'desc' => '会员等级'),
                'cashback_percentage'=> array('name' => 'cashback_percentage',  'desc' => '返现比例','require' => true),
                'cashback_price' => array('name' => 'cashback_price', 'type' => 'string', 'desc' => '返现价格'),
                'operation' => array('name' => 'operation', 'type' => 'string', 'require' => true,'desc' => '操作人')
            ),
            'update' => array(
                'id' 	=> array('name' => 'id', 'type' =>'string', 'require' => true,'desc' => 'id'),
                'level' => array('name' => 'level', 'type' => 'string', 'require' => true, 'desc' => '会员等级'),
                'cashback_percentage'=> array('name' => 'cashback_percentage',  'desc' => '返现比例','require' => true),
                'cashback_price' => array('name' => 'cashback_price', 'type' => 'string', 'desc' => '返现价格'),
                'operation' => array('name' => 'operation', 'type' => 'string', 'require' => true,'desc' => '操作人')
            ),
            'deleteById' => array(
                'id' 	=> array('name' => 'id', 'type' =>'string', 'require' => true)
            ),
        );
    }


    /**
     * 获取返现比例信息列表
     * @desc  获取返现比例信息列表
     */
    public function getlist()
    {

        $rs = array('code' => 0, 'msg' => '', 'info' => array());

        $product = new Domain_Percentage();

        $result = $product->getlist($this);

        if ($result) {

            $rs['code'] = 1;

            $rs['info'] = $result;
        }

        return $rs;

    }

    /**
     * 新增返现比例
     * @return array
     */
    public function insert(){

        $rs = array('code' => 0, 'msg' => '', 'info' => array());

        $product = new Domain_Percentage();

        $result = $product->insert($this);

        if($result){

            $rs['code'] = 1;

            $rs['info'] = $result;
        }

        return $rs;

    }
    /**
     * 修改返现比例
     * @return array
     */
    public function update(){

        $rs = array('code' => 0, 'msg' => '', 'info' => array());

        $product = new Domain_Percentage();

        $result = $product->update($this);

        if($result){

            $rs['code'] = 1;

            $rs['info'] = $result;
        }

        return $rs;

    }

    /**
     * 删除返现比例
     */
    public function deleteById(){

        $rs = array('code' => 0, 'msg' => '', 'info' => array());

        $id = $this ->id;

        $domain = new Domain_Percentage();

        $result = $domain->deleteById($id);

        if($result=="success"){

            $rs['code'] = 1;

            $rs['info'] = $result;
        }

        return $rs;
    }
}