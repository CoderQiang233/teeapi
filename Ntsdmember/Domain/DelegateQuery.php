<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/10/10 0010
 * Time: 下午 3:00
 */
class Domain_delegateQuery{

    public  function getBaseInfo($order_id){

        $model = new Model_delegateQuery();

        return $model->getResult($order_id);

    }
}