<?php
/**
 * 上传接口
 * User: Administrator
 * Date: 2018/5/24
 * Time: 10:40
 */
class Api_Upload extends PhalApi_Api {

    /**
     * 获取参数
     * @return array 参数信息
     */
    public function getRules() {
        return array(
            'upload' => array(
                'file' => array(
                    'name' => 'file',
                    'type' => 'file',
                    'min' => 0,
                    'range' => array('image/jpg', 'image/jpeg', 'image/png'),
                    'ext' => array('jpg', 'jpeg', 'png')
                ),
            ),
        );
    }

    /**
     * 上传文件
     * @return string $url 绝对路径
     * @return string $file 相对路径，用于保存至数据库，按项目情况自己决定吧
     */
    public function upload() {
        DI()->logger->info('上傳:進入上傳');
        //设置上传路径 设置方法参考3.2
        DI()->ucloud->set('save_path', 'image');
        $name =$this->file['name'];
        $name = explode('.', $name);
        $name=$name[0].time();
        //新增修改文件名设置上传的文件名称
        DI()->ucloud->set('file_name', $name);
        $result = DI()->ucloud->upfile($this->file);
        return  $result;
    }
}
?>