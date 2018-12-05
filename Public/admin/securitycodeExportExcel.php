<?php
/**
 * Created by PhpStorm.
 * User: ${zhouyuan}
 * Date: 2018/9/28
 * Time: 17:08
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

$filename=date("Y-m-d",time()).'防伪码';
$time=date("Y.m.d");
$file=$dir.'\export'.'/export'.$time.'.xls';

$header = array('防伪码id','防伪码','生成时间');
$orders=getOrder();//获取部件数据
$indexKey = array('id','securitycode','generatetime');
exportExcel($orders,$filename,$indexKey,$header);//导出

//输出到浏览器
function exportExcel($list,$filename,$indexKey,$header){
    header("Content-type:application/vnd.ms-excel");
    header("Content-Disposition:filename=".$filename.".xls");
    $teble_header = implode("\t",$header);
    $strexport = $teble_header."\r";
    foreach ($list as $row){
        foreach($indexKey as $val){
            $strexport.=$row[$val]."\t";
        }
        $strexport.="\r";

    }
    DI()->logger->info('导出2',$strexport.="\r");
    $strexport=iconv('UTF-8',"GB2312//IGNORE",$strexport);
    DI()->logger->info('导出3',$strexport);

    $objPHPExcel = new PHPExcel();
    $objPHPExcel->setActiveSheetIndex(0)                                                                            // set table header content
    ->setCellValue('A1', '防伪码id')
        ->setCellValue('B1', '防伪码')
        ->setCellValue('C1', '生成时间');
    $a = 1;                                                                                                         //设置默认值
    foreach($list as $k) {
        $a++;
        $objPHPExcel->setActiveSheetIndex(0)
            ->setCellValue('A'.$a, $k['id'])
            ->setCellValueExplicit('B' . $a, $k['securitycode'], PHPExcel_Cell_DataType::TYPE_STRING)//设置数字的科学计数法显示为文本
            ->setCellValue('C'.$a, $k['generatetime']);

    }
    $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');                                          //excel5为xls格式，excel2007为xlsx格式
    $objWriter->save('php://output');
   // exit($strexport);
}

//获取当日所有防伪码的数据
function getOrder(){
    //数据库获取数据
    $today=date("Y-m-d",time());
    $rows = DI()->notorm->security_code->where('generatetime', $today)->fetchAll();
    DI()->logger->info('导出',$rows);
    return $rows;
}
