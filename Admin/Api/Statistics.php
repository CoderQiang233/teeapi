<?php
/**
 * 签到统计相关接口
 * User: Administrator
 * Date: 2018/5/25
 * Time: 16:08
 */
class Api_Statistics extends PhalApi_Api {
    public function getRules() {
        return array(
            'getStatisticsList' => array(
                'departmentId' 	=> array('name' => 'departmentId',  'type' => 'string', 'require' => false, 'desc' => '部门ID' ),
                'dateTime' 	=> array('name' => 'dateTime',  'type' => 'string', 'require' => false, 'desc' => '时间' ),
            ),
            'getSignInList'=> array(
                'meetingId' 	=> array('name' => 'meetingId',  'type' => 'string', 'require' => true, 'desc' => '所属会议ID' ),
                'signInType' 	=> array('name' => 'signInType',  'type' => 'string', 'require' => true, 'desc' => '签到情况' ),

            ),
            'exportSignInList'=> array(
                'meetingId' 	=> array('name' => 'meetingId',  'type' => 'string', 'require' => true, 'desc' => '所属会议ID' ),
                'signInType' 	=> array('name' => 'signInType',  'type' => 'string', 'require' => true, 'desc' => '签到情况' ),

            ),

        );}

    /**
     * 获取统计列表
     * @desc 获取统计列表
     * @return int code 操作码，1表示成功， 0表示失败
     * @return string msg 提示信息
     */
    public function getStatisticsList(){
        $rs = array('code' => 1, 'msg' => '', 'list' => []);
        $domain=new Domain_Statistics();
        $data=$domain->getStatisticsList($this);
        $rs['list']=$data;
        return $rs;
    }

    /**
     * 查看签到人员
     * @desc 查看签到人员
     * @return int code 操作码，1表示成功， 0表示失败
     * @return string msg 提示信息
     */
    public function getSignInList(){
        $rs = array('code' => 1, 'msg' => '', 'list' => []);
        $domain=new Domain_Statistics();
        $data=$domain->getSignInList($this->meetingId,$this->signInType);
        $rs['list']=$data;
        return $rs;
    }
    /**
     * 导出签到人员
     * @desc 导出签到人员
     * @return int code 操作码，1表示成功， 0表示失败
     * @return string msg 提示信息
     */
    public function exportSignInList(){
        $rs = array('code' => 1, 'msg' => '', 'list' => []);
        $domain=new Domain_Statistics();
        $data=$domain->exportSignInList($this->meetingId,$this->signInType);
        $rs['list']=$data;
//        $data=array(
//            array('username'=>'zhangsan','password'=>"123456"),
//            array('username'=>'lisi','password'=>"abcdefg"),
//            array('username'=>'wangwu','password'=>"111111"),
//        );
        $meeting=DI()->notorm->meetinginfo->select('meetingName')->where('id',$this->meetingId)->fetchOne();
        $filename    =$meeting['meetingName'].'.xlsx';
        $headArr     = array("姓名", "工号","部门","签到情况","签到时间","签到地点","随堂测试",'签退情况','签退时间','签退地点');
        $PHPExcel = new PHPExcel_Lite();
        $PHPExcel->exportExcel($filename, $data, $headArr);

//        return $rs;
    }



}