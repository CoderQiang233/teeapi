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


    public function search($data)
    {

        try {

            $model = new Model_IndexPage();

            $res = $model->search($data->name);

            return $res;

        } catch (Exception $e) {

            DI()->logger->error('首页检索失败', '商品名:' . $data->name . '异常信息:' . $e);

            return false;
        }
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
//            if (property_exists($setting,'product')){
                if (isset($setting->product)){
                $proid=$setting->product;
                if(is_array($proid)){
                    $pro=array();
                    foreach ($proid as $id){
                        array_push($pro,$model->getProduct($id));
                    }
                }else{
                    $pro=$model->getProduct($proid);
                }

                $setting->product=$pro;
            }
            $settingStr=json_encode($setting);
            $moduleItem['setting']=$setting;
            array_push($modules,$moduleItem);
        }
        return $modules;
    }
}