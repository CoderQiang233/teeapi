<?php
/**
 * Created by PhpStorm.
 * User: ${zhouyuan}
 * Date: 2018/9/26
 * Time: 14:34
 */
class Domain_Member {


    public function getMemberList($data)
    {
        $model = new Model_Member();

        $rs = $model->getMemberList($data);
        return $rs;
    }
    public function getMemberLevelCount($data)
    {
        $model = new Model_Member();

        $rs = $model->getMemberLevelCount($data);
        return $rs;
    }
    }