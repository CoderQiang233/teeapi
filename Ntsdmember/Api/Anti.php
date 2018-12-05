<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/9/29 0029
 * Time: 下午 2:49
 * 防伪验证接口
 */
class Api_anti extends PhalApi_Api
{
    public function getRules()
    {
        return array(
            'getAntiId' => array(
                'securitycode' => array('name' => 'securitycode', 'type' => 'string', 'require' => true),
            ),

            'getScrollImg' => array(//                'securitycode' => array('name' => 'securitycode', 'type' => 'string', 'require' => true),
            ),
            'getImg' => array(//                'securitycode' => array('name' => 'securitycode', 'type' => 'string', 'require' => true),
            ),
        );
    }

//防伪验证的接口
    public function getAntiId()
    {

        $securitycode = $this->securitycode;

        $rs = array('code' => 0, 'msg' => '', 'info' => array());

        $domain = new Domain_Anti();

        $info = $domain->getAntiId($this->securitycode);


        if (empty($info)) {
            DI()->logger->debug('user not found', $this->securitycode);

            $rs['code'] = 1;
            $rs['msg'] = T('user not exists');
            return $rs;
        }

        $rs['info'] = $info;

        return $rs;


    }

    //滑动试图的图片

    public function getScrollImg()
    {


        $rs = array('code' => 0, 'msg' => '', 'info' => array());

        $domain = new Domain_Anti();

        $info = $domain->getImg();


        if (empty($info)) {
            DI()->logger->debug('user not found', $this->securitycode);

            $rs['code'] = 1;
            $rs['msg'] = T('user not exists');
            return $rs;
        }
        $rs['info'] = $info;
        return $rs;
    }


    //滑动试图的图片(产品系列上方试图 )

    public function getImg()
    {


        $rs = array('code' => 0, 'msg' => '', 'info' => array());

        $domain = new Domain_Anti();

        $info = $domain->getPic();


        if (empty($info)) {
            DI()->logger->debug('user not found', $this->securitycode);

            $rs['code'] = 1;
            $rs['msg'] = T('user not exists');
            return $rs;
        }
        $rs['info'] = $info;
        return $rs;
    }

}
