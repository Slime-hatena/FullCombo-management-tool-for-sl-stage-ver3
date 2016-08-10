<?php
//this file is include only!
// 形式は次の通り
//>>1451574000_192.168.1.1_login.php.txt
//      UnixTime IPアドレス 生成されたファイル名
/*
$logWrite = "内容";
include($_SERVER['DOCUMENT_ROOT'] . "/fcMgt4slStage/log/logWriter.php");
*/

$log_dir_pass = dirname(__file__);
$log_file_pass = $_SERVER['PHP_SELF'];
$log_file_name = basename($_SERVER['PHP_SELF']);
$log_ip_address = $_SERVER["REMOTE_ADDR"];
$log_unix_time = time();

if($log_ip_address == "::1"){
    $log_ip_address = "localhost";
}else{
    $log_ip_address = ip2long($log_ip_address);
}

$log_txt_name = $log_unix_time . "_" . $log_ip_address . "_" . $log_file_name .  '.txt';
touch($_SERVER['DOCUMENT_ROOT'] . "/fcMgt4slStage/log/" . $log_txt_name);

//ここから内容
if(!(isset($logWrite))){
    $logWrite = "none";
}

$log_write="serverTime : ". date("Y/m/d H:i:s (P)", $log_unix_time) . "
ipAddress : " . $log_ip_address . "
fileName : " . $log_dir_pass . "/" . $log_file_name . "

=============================
" . $logWrite ;

$fp = fopen($_SERVER['DOCUMENT_ROOT'] . "/fcMgt4slStage/log/" . $log_txt_name, "w");
fwrite($fp, $log_write);
fclose($fp);