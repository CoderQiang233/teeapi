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
    public function getModules(){
        $model=new Model_IndexPage();
        $rel=$model->getModules();
        $modules=array();
        $moduleItem=array();
        foreach ($rel as $item){
            $moduleItem['keyword']=$item['keyword'];
            $moduleItem['name']=$item['name'];
            $moduleItem['id']=$item['module_id'];
            $setting=json_decode($item['setting']);
            if ($setting->product){
                $proid=$setting->product;
                $pro=$model->getProduct($proid);
                $setting->product=$pro;
            }
            $settingStr=json_encode($setting);
            $moduleItem['setting']=$setting;
            array_push($modules,$moduleItem);
        }
        return $modules;
    }
}