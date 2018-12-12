<?php
/**
 * Ntsdmember 统一入口
 */

require_once dirname(__FILE__) . '/../init.php';


//装载你的接口
DI()->loader->addDirs('Weixin');

DI()->loader->addDirs('Library');

DI()->wechatMini = new WechatMini_Lite();

//支付
DI()->pay = new Pay_Lite();

//短信
DI()->sms = new Sms_Lite();

/** ---------------- 响应接口请求 ---------------- **/

$api = new PhalApi();
$rs = $api->response();
$rs->output();

