<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/10/19 0019
 * Time: 上午 10:10
 */

class Model_NewsList extends PhalApi_Model_NotORM
{
    public function getNewsList(){

        return DI()->notorm->news->where('status','1') -> fetchAll();

    }

    public function getconpany(){

        return DI()->notorm->company_profile->where('status','1') -> fetchOne();

    }


    public function getNewsListByID($id){

        return DI()->notorm->news->where('id',$id) -> fetchAll();

    }
}