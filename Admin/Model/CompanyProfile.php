<?php
/**
 * Created by PhpStorm.
 * User: ${zhouyuan}
 * Date: 2018/10/19
 * Time: 15:40
 */
class Model_CompanyProfile extends PhalApi_Model_NotORM
{


    public function getList($data)
    {
        $pageSize='';//每页条数

        $pageIndex='';//当前页


        if('undefined' !== $data->pageSize && '' !== $data->pageSize && null !== $data->pageSize ){

            $pageSize=$data->pageSize;

        }

        if('undefined' !== $data->pageIndex && '' !== $data->pageIndex && null !== $data->pageIndex ){

            $pageIndex=$data->pageIndex;

        }
        $start_page=$pageSize*($pageIndex-1);

        $products = DI()->notorm->company_profile->limit($start_page, $pageSize)->order('id DESC')->fetchAll();

        $total=count(DI()->notorm->company_profile->fetchAll());

        return array(
            'list' => $products,
            'total' => $total,
            'pageIndex' => $pageIndex,
        );

    }

    public function insertNews($data)
    {

        try {

            $company_profile=DI()->notorm->company_profile->fetchAll();
            $info = array(
                'title' => $data->title,
                'content' => $data->content,
                'addtime' => date("Y-m-d H:i:s"),
                'status'=>'2',//公司简介默认为停用状态
            );
            if($company_profile){
                $result='公司简介只能存在一条信息!';
                return $result;
            }else{
                $result = DI()->notorm->company_profile->insert($info);
                return true;
            }


        } catch (Exception $e) {
            return false;
        }
    }


    public function updateNews($data)
    {

        try {
            $info = array(
                'title' => $data->title,
                'content' => $data->content,
                'addtime' => date("Y-m-d H:i:s"),
            );
            DI()->notorm->company_profile->where('id', $data->id)->update($info);

            return true;

        } catch (Exception $e) {
            return false;
        }
    }


    public function deleteById($id)
    {

        try {
            //删除
            DI()->notorm->company_profile->where('id', $id)->delete();

            return "success";

        } catch (Exception $e) {
            echo $e->getMessage();

            return "error";
        }
    }
    public function change($data)
    {

        try {
            $status=$data->status;
            if($status=='1'){
                $arr = array('status' => '2');
                DI()->notorm->company_profile->where('id', $data->id)->update($arr);
            }else{
                $arr = array('status' => '1');
                DI()->notorm->company_profile->where('id', $data->id)->update($arr);
            }
            return true;

        } catch (Exception $e) {
            return false;
        }
    }
}