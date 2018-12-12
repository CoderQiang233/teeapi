<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/12/12
 * Time: 14:02
 */
class Domain_IndexPage{
    public function getBanner(){
        $model=new Model_IndexPage();
        $rel=$model->getBanner();
        return $rel;
    }
}