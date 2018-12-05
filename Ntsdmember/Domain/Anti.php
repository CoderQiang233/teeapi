<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/9/29 0029
 * Time: 下午 3:40
 */

class Domain_Anti
{
    //防伪验证
    public function getAntiId($securitycode)
    {
        $model = new Model_Anti();

        return $model->getAntiId($securitycode);
    }

    //滑动式图
    public function getImg()
    {
        $model = new Model_Anti();

        return $model->getImg();
    }

    //滑动式图
    public function getPic()
    {
        $model = new Model_Anti();

        return $model->getPic();
    }
}