<?php
/**
 * Created by PhpStorm.
 * User: ${zhouyuan}
 * Date: 2018/10/17
 * Time: 14:51
 */
class Model_News extends PhalApi_Model_NotORM
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

        $products = DI()->notorm->news->limit($start_page, $pageSize)->order('id DESC')->fetchAll();

        $total=count(DI()->notorm->news->fetchAll());

        return array(
            'list' => $products,
            'total' => $total,
            'pageIndex' => $pageIndex,
        );

    }

    public function insertNews($data)
    {

        try {
            $info = array(
                'title' => $data->title,
                'imgurl' => $data->imgurl,
                'content' => $data->content,
                'addtime' => date("Y-m-d H:i:s"),
                'status'=>'2',//新增新闻默认为停用状态
            );
            $result = DI()->notorm->news->insert($info);

            return true;

        } catch (Exception $e) {
            return false;
        }
    }


    public function updateNews($data)
    {

        try {
            $info = array(
                'title' => $data->title,
                'imgurl' => $data->imgurl,
                'content' => $data->content,
                'addtime' => date("Y-m-d H:i:s"),
            );
            DI()->notorm->news->where('id', $data->id)->update($info);

            return true;

        } catch (Exception $e) {
            return false;
        }
    }


    public function deleteById($id)
    {

        try {
            //删除
            DI()->notorm->news->where('id', $id)->delete();

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
                DI()->notorm->news->where('id', $data->id)->update($arr);
            }else{
                $arr = array('status' => '1');
                DI()->notorm->news->where('id', $data->id)->update($arr);
            }
            return true;

        } catch (Exception $e) {
            return false;
        }
    }
}