<?php
/**
 * Created by PhpStorm.
 * User: ${zhouyuan}
 * Date: 2018/9/28
 * Time: 10:45
 */
class Domain_SecurityCode {


    public function getSecurityCodeList($data)
    {
        $model = new Model_SecurityCode();

        $rs = $model->getSecurityCodeList($data);
        return $rs;
    }
    public function generateSecurityCode($data)
    {
        $model = new Model_SecurityCode();

        $rs = $model->generateSecurityCode($data);
        return $rs;
    }
}