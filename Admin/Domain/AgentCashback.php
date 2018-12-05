<?php
/**
 * Created by PhpStorm.
 * User: ${zhouyuan}
 * Date: 2018/10/19
 * Time: 15:36
 */


class Domain_AgentCashback
{


    public function getMemberList($data)
    {
        $model = new Model_AgentCashback();

        $rs = $model->getMemberList($data);
        return $rs;
    }
    public function getMemberListMsg($data)
    {
        $model = new Model_AgentCashback();

        $rs = $model->getMemberListMsg($data);
        return $rs;
    }
    public function getAgentCashbackList($data)
    {
        $model = new Model_AgentCashback();

        $rs = $model->getAgentCashbackList($data);
        return $rs;
    }
    public function getAgentCashbackMonthList($data)
    {
        $model = new Model_AgentCashback();

        $rs = $model->getAgentCashbackMonthList($data);
        return $rs;
    }
    public function updateCashStatus($data)
    {
        $model = new Model_AgentCashback();

        $rs = $model->updateCashStatus($data);
        return $rs;
    }
}