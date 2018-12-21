<?php
/**
 * Meeting 统一入口
 */

require_once dirname(__FILE__) . '/../init.php';
DI()->logger->info('进入index');
//装载你的接口
DI()->loader->addDirs('Admin');

DI()->loader->addDirs('Library');
//支持JsonP的返回
if (!empty($_GET['callback'])) {
    DI()->response = new PhalApi_Response_JsonP($_GET['callback']);
}
/** ---------------- 响应接口请求 ---------------- **/

$api = new PhalApi();
$rs = $api->response();
$rs->output();

