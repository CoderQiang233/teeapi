<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/5/16
 * Time: 17:42
 */
class Model_Department extends PhalApi_Model_NotORM{
    public function getDepartmentList($data){

        $departmentId=$data->departmentId;
        $phoneNum=$data->phoneNum;
        $select=DI()->notorm->department;
        if ('undefined' !== $departmentId && '' !== $departmentId && null !== $departmentId ){
            $select=$select->where('id',$departmentId);
        }
        if ('undefined' !== $phoneNum && '' !== $phoneNum && null !== $phoneNum ){
            $select=$select->where('inchargeTel',$phoneNum);
        }


        $rel=$select->select('*')->fetchAll();
        return $rel;
    }
    public function getDepartments(){
        $data=DI()->notorm->department->select('deptName,id')->fetchAll();
        return $data;
    }

    public function addDepartment($data){
        $rs=DI()->notorm->department->select('id')->or('deptName',$data->deptName)->or('deptCode',$data->deptCode)->fetchOne();
        if ($rs['id']){
            return Common_GetReturn::getReturn(false,'该部门已存在',[]);
        }
        $arr = array(
            'deptName'  => $data->deptName,
            'deptCode' => $data->deptCode,
            'numbers' => $data->numbers,
            'incharge' => $data->incharge,
            'inchargeTel' => $data->inchargeTel,
        );
        $rs   = DI()->notorm->department->insert($arr);
        $rel=DI()->notorm->department->fetchAll();
        return Common_GetReturn::getReturn(true,'添加成功',$rel);
    }

    public function deleteDepartment($data){
        $id=$data->departmentId;
        $rel=DI()->notorm->department->where('id', $id)->delete();

        if ($rel===false){
            $rel=Common_GetReturn::getReturn(false,'删除数据失败',[]);
            return $rel;
        }
        $list=DI()->notorm->department->fetchAll();
        $rel=Common_GetReturn::getReturn(true,'删除数据成功',$list);
        return $rel;
    }

    public function editDepartment($data){
        $arr = array(
            'deptName'  => $data->deptName,
            'deptCode' => $data->deptCode,
            'numbers' => $data->numbers,
            'incharge' => $data->incharge,
            'inchargeTel' => $data->inchargeTel,
        );
        $rs   = DI()->notorm->department->where('id', $data->departmentId)->update($arr);
        if($rs === false){
            $rel=Common_GetReturn::getReturn(false,'修改数据失败',[]);
            return $rel;
        }
        $list=DI()->notorm->department->fetchAll();
        $rel=Common_GetReturn::getReturn(true,'修改数据成功',$list);
        return $rel;
    }
}