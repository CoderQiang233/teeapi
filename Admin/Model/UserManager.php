<?php

/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/5/22
 * Time: 15:02
 */
class Model_UserManager extends PhalApi_Model_NotORM
{
    public function getUserList($data)
    {
        $departmentId = $data->departmentId;
        $phoneNum = $data->phoneNum;
        $role = $data->role;
        $where = '';
        if ('undefined' !== $departmentId && '' !== $departmentId && null !== $departmentId) {
            $where = $where . ' AND department="' . $departmentId . '"';
        }
        if ('undefined' !== $phoneNum && '' !== $phoneNum && null !== $phoneNum) {
            $where = $where . ' AND tel="' . $phoneNum . '"';
        }
        if ('undefined' !== $role && '' !== $role && null !== $role) {
            $where = $where . ' AND role="' . $role . '"';
        }
        $sql = 'SELECT * '
            . 'FROM shop_user  '
            . ' WHERE 1=1 ' . $where
            . 'ORDER BY id';

        $rows = $this->getORM()->queryAll($sql);
        return $rows;
    }

    public function addUser($data)
    {
        $rs = DI()->notorm->user->select('id')->where('userName', $data->userName)->fetchOne();
        if ($rs['id']) {
            return Common_GetReturn::getReturn(false, '该用户已存在', []);
        }
        $arr = array(
            'userName' => $data->userName,
            'name' => $data->name,
            'pwd' => hash("sha256", $data->pwd),
            'tel' => $data->tel,
            'role' => $data->role,
        );
        $rs = DI()->notorm->user->insert($arr);
        $sql = 'SELECT * '
            . 'FROM shop_user'
            . ' WHERE 1=1 '
            . 'ORDER BY id';

        $rows = $this->getORM()->queryAll($sql);
        return Common_GetReturn::getReturn(true, '添加成功', $rows);
    }

    public function editUser($data)
    {
//        $rs=DI()->notorm->user->select('id')->where('userName',$data->userName)->fetchOne();
//        if ($rs['id']){
//            return Common_GetReturn::getReturn(false,'该用户已存在',[]);
//        }
        $arr = array(
            'userName' => $data->userName,
            'name' => $data->name,
            'tel' => $data->tel,
            'role' => $data->role,
        );
        $rs = DI()->notorm->user->where('id', $data->userId)->update($arr);
        if ($rs === false) {
            $rel = Common_GetReturn::getReturn(false, '修改数据失败', []);
            return $rel;
        }
        $sql = 'SELECT * '
            . 'FROM shop_user'
            . ' WHERE 1=1 '
            . 'ORDER BY id';

        $rows = $this->getORM()->queryAll($sql);
        $rel = Common_GetReturn::getReturn(true, '修改数据成功', $rows);
        return $rel;
    }

    public function deleteUser($data)
    {
        $id = $data->userId;
        if($id!="1"){
            $rel = DI()->notorm->user->where('id', $id)->delete();
        }else{
            $rel = Common_GetReturn::getReturn(false, 'admin不可删除', []);
            return $rel;
        }
        if ($rel === false) {
            $rel = Common_GetReturn::getReturn(false, '删除数据失败', []);
            return $rel;
        }
        $sql = 'SELECT * '
            . 'FROM shop_user'
            . ' WHERE 1=1 '
            . 'ORDER BY id';
        $rows = $this->getORM()->queryAll($sql);
        $rel = Common_GetReturn::getReturn(true, '删除数据成功', $rows);
        return $rel;
    }

    public function editPwd($data)
    {
        $userId = $data->userId;
        $oPwd = hash("sha256", $data->oPwd);
        $nPwd = hash("sha256", $data->nPwd);
        $user = DI()->notorm->user->select('*')->where('id', $userId)->fetchOne();
        if ($user['pwd'] == $oPwd) {
            $arr = array(
                'pwd' => $nPwd
            );
            $rs = DI()->notorm->user->where('id', $userId)->update($arr);
            if ($rs === false) {
                $rel = Common_GetReturn::getReturn(false, '修改数据失败', []);
                return $rel;
            } else {
                $rel = Common_GetReturn::getReturn(true, '修改数据成功', []);
                return $rel;
            }

        } else {
            $rel = Common_GetReturn::getReturn(false, '旧密码不正确', []);
            return $rel;
        }
    }

    public function adminEditPwd($data)
    {
        $userId = $data->userId;
        //$oPwd=hash("sha256", $data->oPwd);
        $nPwd = hash("sha256", $data->nPwd);
        $user = DI()->notorm->user->select('*')->where('id', $userId)->fetchOne();
        $arr = array(
            'pwd' => $nPwd
        );
        $rs = DI()->notorm->user->where('id', $userId)->update($arr);
        if ($rs === false) {
            $rel = Common_GetReturn::getReturn(false, '修改数据失败', []);
            return $rel;
        } else {
            $rel = Common_GetReturn::getReturn(true, '修改数据成功', []);
            return $rel;
        }


    }
}