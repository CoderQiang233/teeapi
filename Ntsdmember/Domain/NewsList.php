<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/10/19 0019
 * Time: 上午 10:09
 */
class Domain_NewsList{

    public  function getNewsLists(){

        $model = new Model_NewsList();

        return $model->getNewsList();

    }


    public  function getNewsListByID($id){

        $model = new Model_NewsList();

        return $model->getNewsListByID($id);

    }

    public  function getconpany(){

        $model = new Model_NewsList();

        return $model->getconpany();

    }
}