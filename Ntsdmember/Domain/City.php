<?php
/**
 * Created by PhpStorm.
 * User: ${zhouyuan}
 * Date: 2018/10/23
 * Time: 15:19
 */

class Domain_City {


    public function getCityList($data)
    {
        $model = new Model_City();

        $rs = $model->getCityList($data);

        return $rs;
    }
}