<?php
/**
 * Created by PhpStorm.
 * User: NUIZ
 * Date: 17/8/2558
 * Time: 15:13
 */

//$archivePath = 'excel_tmp.xlsx';
//$filePath = 'xl/workbook.xml';
//$tmp = tempnam(sys_get_temp_dir(), 'xls_parser_archive');
//unlink($tmp);
//$tempPath = sprintf('%s/%s', $tmp, $filePath);
//
//$zip = new \ZipArchive();
//if (true !== $zip->open($archivePath)) {
//    throw new \RuntimeException('Error opening file');
//}
//
//if (!file_exists($tempPath)) {
//    echo "extractTo ".$tempPath;
//    $zip->extractTo($tempPath, $filePath);
//}
//
//$files = new \RecursiveIteratorIterator(
//    new \RecursiveDirectoryIterator($tmp, \RecursiveDirectoryIterator::SKIP_DOTS),
//    \RecursiveIteratorIterator::CHILD_FIRST
//);
//
//foreach ($files as $file) {
//    if ($file->isDir()) {
//        rmdir($file->getRealPath());
//    } else {
//        unlink($file->getRealPath());
//    }
//}
//rmdir($tmp);

require ("vendor/autoload.php");

$fileName = 'excel_tmp.xlsx';

$workbook = \Akeneo\Component\SpreadsheetParser\SpreadsheetParser::open($fileName);
$myWorksheetIndex = $workbook->getWorksheetIndex('myworksheet');

$iterator = $workbook->createRowIterator($myWorksheetIndex);
foreach($iterator as $key=> $value){
    if($key <=2) continue;
    var_dump($key, $value);
    flush();
    if($key > 10) break;
}


$test = 334;
