<?php
/**
 * Created by PhpStorm.
 * User: Administrator
<<<<<<< HEAD
 * Date: 2018/5/21
 * Time: 11:46
 */
class Model_Staff extends PhalApi_Model_NotORM{

    protected function getTableName($id) {
        switch ($id){
            case 'dept':
                return 'department';
            case 'staff':
                return 'staff';
        }
    }


    public function getStaffList($data){
        $departmentId=$data->departmentId;
        $jobNum=$data->jobNum;
        $where='';
        if ('undefined' !== $departmentId && '' !== $departmentId && null !== $departmentId ){
            $where=$where.' AND department="'.$departmentId.'"';
        }
        if ('undefined' !== $jobNum && '' !== $jobNum && null !== $jobNum ){
            $where=$where.' AND jobNum="'.$jobNum.'"';
        }
        $sql = 'SELECT s.*,d.deptName '
            . 'FROM hy_staff s  LEFT JOIN hy_department d '
            . ' ON s.department=d.id '
            .' WHERE 1=1 '. $where
            .'ORDER BY d.id';

        $rows = $this->getORM()->queryAll($sql);
        return $rows;

    }

    public function addStaff($data){
        $rs=DI()->notorm->staff->select('id')->where('jobNum',$data->jobNum)->fetchOne();
        if ($rs['id']){
            return Common_GetReturn::getReturn(false,'该工号已存在',[]);
        }
        $arr = array(
            'name'  => $data->name,
//            'age' => $data->age,
            'sex' => $data->sex,
            'phoneNum' => $data->phoneNum,
            'position' => $data->position,
            'department' => $data->department,
            'email' => $data->email,
            'jobNum' => $data->jobNum,
        );
        $rs   = DI()->notorm->staff->insert($arr);
        $sql = 'SELECT s.*,d.deptName '
            . 'FROM hy_staff s  LEFT JOIN hy_department d '
            . ' ON s.department=d.id '
            .' WHERE 1=1 '
            .'ORDER BY d.id';
        $rows = $this->getORM()->queryAll($sql);
        return Common_GetReturn::getReturn(true,'添加成功',$rows);
    }

    public function editStaff($data){
        $rs=DI()->notorm->staff->select('id')->where('jobNum',$data->jobNum)->fetchOne();
        if ($rs['id']){
            return Common_GetReturn::getReturn(false,'该工号已存在',[]);
        }
        $arr = array(
            'name'  => $data->name,
//            'age' => $data->age,
            'sex' => $data->sex,
            'phoneNum' => $data->phoneNum,
            'position' => $data->position,
            'department' => $data->department,
            'email' => $data->email,
            'jobNum' => $data->jobNum,
        );
        $rs   = DI()->notorm->staff->where('id', $data->staffId)->update($arr);
        if($rs === false){
            $rel=Common_GetReturn::getReturn(false,'修改数据失败',[]);
            return $rel;
        }
        $sql = 'SELECT s.*,d.deptName '
            . 'FROM hy_staff s  LEFT JOIN hy_department d '
            . ' ON s.department=d.id '
            .' WHERE 1=1 '
            .'ORDER BY d.id';
        $rows = $this->getORM()->queryAll($sql);
        $rel=Common_GetReturn::getReturn(true,'修改数据成功',$rows);
        return $rel;
    }

    public function deleteStaff($data)
    {
        $id = $data->staffId;
        $rel = DI()->notorm->staff->where('id', $id)->delete();

        if ($rel === false) {
            $rel = Common_GetReturn::getReturn(false, '删除数据失败', []);
            return $rel;
        }
        $sql = 'SELECT s.*,d.deptName '
            . 'FROM hy_staff s  LEFT JOIN hy_department d '
            . ' ON s.department=d.id '
            . ' WHERE 1=1 '
            . 'ORDER BY d.id';
        $rows = $this->getORM()->queryAll($sql);
        $rel = Common_GetReturn::getReturn(true, '删除数据成功', $rows);
        return $rel;
    }



    public function getStaffTree(){
        $deptList=$this->getORM('dept')->select('*');
        $rs = [];
        foreach ($deptList as $key=>$value){
            $rs[$key]=array(
                'label'=>$value['deptName'],
                'key'=>$value['deptName'],
                'value'=>$value['deptName']
            );
            $staffList = $this->getORM('staff')->select('*')->where('department',$value['id'])->fetchAll();
            foreach ($staffList as $item=>$itemValue){
                $rs[$key]['children'][$item]=array(
                    'label'=>$itemValue['name'],
                    'key'=>$itemValue['id'],
                    'value'=>$itemValue['id'],
                );
            }
        }
        return $rs;
    }


    public function importStaff($data){
        $column=array(
            'department'=>'',
            'jobNum'=>'',
            'name'=>'',
            'sex'=>'',
            'position'=>'',
            'email'=>'',
            'phoneNum'=>''
        );
        $def=array_diff_key($data[0],$column);
        if (!empty($def)){
            return  $rs = array('code' => 0, 'msg' => '模板文件不匹配！！！','list'=>[]);
        }
        foreach ($data as $key=>$staff){

            $data[$key]['jobNum']=(string)$staff['jobNum'];
        }


        DI()->notorm->beginTransaction('db_meeting');
        try{
            $rel=DI()->notorm->staff->insert_multi($data);
        }catch (Exception $ex){
            DI()->notorm->rollback('db_meeting');
            $message=$ex->getMessage();
            return $rs = array('code' => 0, 'errormsg' => $message,'msg'=>'导入数据有误，导入失败。'.$ex,'list'=>[]);
        }

        DI()->notorm->commit('db_meeting');

        $sql = 'SELECT s.*,d.deptName '
            . 'FROM hy_staff s  LEFT JOIN hy_department d '
            . ' ON s.department=d.id '
            .' WHERE 1=1 '
            .'ORDER BY d.id';
        $rows = $this->getORM()->queryAll($sql);



        return $rs = array('code' => 1, 'msg' => '导入成功','list'=>$rows);
    }
}