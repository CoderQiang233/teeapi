<?php
/**
 * Created by PhpStorm.
 * User: ${zhouyuan}
 * Date: 2018/9/28
 * Time: 10:46
 */
class Model_SecurityCode extends PhalApi_Model_NotORM
{

    public function getSecurityCodeList($data)
    {
        $today=date("Y-m-d",time());
        $rows = DI()->notorm->security_code->where('generatetime', $today)->order('id DESC')->fetchAll();
        $arry = array(
            'list' => $rows,
        );
        return $arry;
    }

    /**
     * 生成防伪码
     * @param $data要生成的数量
     * @return bool
     */
    public function generateSecurityCode($data){
        $num=$data->num;
        $arr = array();
      //根据数量循环生成16位随机数
        for ($x=1; $x<=$num; $x++) {
            $a = mt_rand(10000000,99999999);//8位随机数
            $b = mt_rand(10000000,99999999);
            $securityCodes=$a.$b;
            $arr['securitycode']=$securityCodes;
            $arr['generatetime'] = date("Y-m-d",time());
            try{

                $res=DI()->notorm->security_code->insert($arr);


            }catch (Exception $e){

                return false;

            }
        }
       if($res==true){
            return true;
       }else{
            return  false;
       }
    }
}