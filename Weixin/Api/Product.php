<?php
/**
 * 商品接口

 */
class Api_Product extends PhalApi_Api {
    public function getRules() {

        return array(

            'getProudct'=>array(
                'id' 	=> array('name' => 'id', 'type' =>'string', 'require' => true),
            )

        );

    }


    /**
     * 通过ID获取商品
     */
    public function getProudct(){
        $rs = array('code' => 0, 'msg' => '', 'info' => '');
        $id = $this ->id;
        $domain = new Domain_Product();

        $rel=$domain->getProudct($id);

        if($rel){
            $rs['code']=1;
            $rs['info']=$rel;
        }
        return $rs;
    }

}