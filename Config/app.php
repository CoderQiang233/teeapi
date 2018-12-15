<?php
/**
 * 请在下面放置任何您需要的应用配置
 */

return array(

    /**
     * 应用接口层的统一参数
     */
    'apiCommonRules' => array(
        //'sign' => array('name' => 'sign', 'require' => true),
    ),

    /**
     * 接口服务白名单，格式：接口服务类名.接口服务方法名
     *
     * 示例：
     * - *.*            通配，全部接口服务，慎用！
     * - Default.*      Api_Default接口类的全部方法
     * - *.Index        全部接口类的Index方法
     * - Default.Index  指定某个接口服务，即Api_Default::Index()
     */
    'service_whitelist' => array(
        'Default.Index',
    ),
    /**
     * 扩展类库 - 微信小程序
     */
    'WechatMini'  => array(
        'appid'      => 'wx6084b273399ab0d4', // AppID(小程序ID)
        'secret'     => 'd273943e74c608bb3be4d793cc91e15f', // AppSecret(小程序密钥)
        'url'        => 'https://api.weixin.qq.com/sns/jscode2session',
        'grant_type' => 'authorization_code'
    ),

    /**
     * 支付相关配置
     */
    'Pay' => array(
        //异步/同步地址
        'notify_url' => 'https://teeshop.zgftlm.com/Public/pay/',

        //支付宝wap端设置
        'aliwap' => array(
            //收款账号邮箱
            'email' => 'admin@admin.com',

            //加密key
            'key' => 'xxx',

            //合作者ID
            'partner' => '123456'
        ),

        //微信支付设置
        'wechat' => array(

            'appid' => 'wx6084b273399ab0d4',

            //商户号
            'mchid' => '1520440971',

            //公众号的appsecret
            'appsecret' => 'd273943e74c608bb3be4d793cc91e15f',

            //微信支付Key
            'key' => '8934e7d15453e97507ef794cf7b0519d'
        ),
    ),

    'UCloudEngine' => 'local',
    'UCloud' => array(
        //对应的文件路径
//        'host' => 'https://xcx.zgftlm.com/Public'
        'host' => 'https://testzlgj.zgftlm.com/Public/upload'
    ),
//    'imagePath' => 'https://xcx.zgftlm.com/Public/upload',
//    'imagePath' => 'https://testzlgj.zgftlm.com/Public/upload',
    'imagePath' => 'http://192.168.10.105/Public/upload',

    'weixinBill' => array(
        'url'=>'https://api.mch.weixin.qq.com/pay/downloadbill',
        'bill_type'=>'SUCCESS',
    ),

);
