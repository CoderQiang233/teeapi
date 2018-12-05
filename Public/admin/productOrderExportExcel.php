<?php
/**
 * Created by PhpStorm.
 * User: niuyuan
 * Date: 2017/11/28
 * Time: 11:53
 */

/**
 * 导出Excel表格
 */
$dir = dirname(__FILE__);
require_once $dir . '/../../Admin/Common/PHPExcel/PHPExcel/CachedObjectStorageFactory.php';
require_once $dir . '/../../Admin/Common/PHPExcel/PHPExcel/Settings.php';
ini_set("memory_limit", "1024M");
set_time_limit(0);
// 设置缓存方式，减少对内存的占用
$cacheMethod = PHPExcel_CachedObjectStorageFactory::cache_to_phpTemp;
$cacheSettings = array ( 'cacheTime' => 300 );
PHPExcel_Settings::setCacheStorageMethod ( $cacheMethod, $cacheSettings );
header('Content-Type: application/json');
header('Content-Type: text/html;charset=utf-8');

require_once $dir . '/../../Admin/Common/PHPExcel/PHPExcel.php';
require_once $dir . '/../../Admin/Common/PHPExcel/PHPExcel/IOFactory.php';
require_once $dir . '/../init.php';

$filename='商品订单';
$time=date("Y.m.d");
$file=$dir.'\export'.'/export'.$time.'.xls';

$header = array('订单编号','客户姓名','客户手机号','商品名称','商品价格','购买数','总价','下单时间','收货地址','发货状态');
$orders=getOrder();//获取部件数据
$indexKey = array('order_id','name','phone','commodity_name','commodity_price','commodity_num','total','updatedAt','shipping_address','ship_status');
exportExcel($orders,$filename,$indexKey,$header);//导出

//输出到浏览器
function exportExcel($list,$filename,$indexKey,$header){
    header("Content-type:application/vnd.ms-excel");
    header("Content-Disposition:filename=".$filename.".xls");
    $teble_header = implode("\t",$header);
    $strexport = $teble_header."\r";
    foreach ($list as $row){
        foreach($indexKey as $val){
            if($val=='ship_status'){
                $strexport.=$row[$val]=='0'?'未发货':'已发货'."\t";
            }else if($val=='total'){
                $strexport.=$row['commodity_price']*$row['commodity_num']."\t";
            }else{
                $strexport.=$row[$val]."\t";
            }
        }
        $strexport.="\r";
    }
    $strexport=iconv('UTF-8',"GB2312//IGNORE",$strexport);
    exit($strexport);
}

//获取所有pay=1的数据
function getOrder(){
    //数据库获取数据
    $sqls = 'SELECT o.*,m.name,m.phone '
        . 'FROM commodity_order AS o  JOIN members AS m '
        . 'ON o.members_id=m.id WHERE o.pay=1 and o.commodity_num>0 order by o.id';

    $orderAll= DI()->notorm->commodity_order->queryAll($sqls);
//    for ($i=0;$i<count($orderAll);$i++){
//        $order=$orderAll[$i];
//        $express=DI()->notorm->commodity_express->where('order_id',$order['id'])->fetchAll();
//        if(count($express)>0){
//            $order['express_number']=$express[0]['express_number'];
//            $order['express_name']=$express[0]['express_name'];
//            $order['ship_time']=$express[0]['ship_time'];
//        }
//    }
    return $orderAll;
}
