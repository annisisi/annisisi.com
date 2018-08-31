<?php

define('BASE_PATH', dirname(dirname(__FILE__)));
define('DEBUG', FALSE);

// composer
require '../vendor/autoload.php';
include '../framework/core/app.php';
$app->run();

//ob_start();
//include '../framework/core/init.php';
//
//include FRANE . '/libraries/Share.php';
//
//$server_name = isset($_SERVER['HTTP_HOST']) ? $_SERVER['HTTP_HOST'] : 'www.annisisi.com';
//
////请求URI获取
//$uri = isset($_SERVER['REQUEST_URI']) ? $_SERVER['REQUEST_URI'] : '/';
//if ($pos = strpos($uri, '?')) {
//    $uri = substr($uri, 0, $pos);
//}
//$uri = trim($uri, '/');  //去除字符串两边空格和其他字符
//
//
////请求协议
//if (isset($_REQUEST['_method'])) {
//    $method = $_REQUEST['_method'];
//} else {
//    $method = isset($_SERVER['REQUEST_METHOD']) ? $_SERVER['REQUEST_METHOD'] : 'GET';
//}
//$method == 'patch' && $method = 'put';
//$method = strtoupper($method);
//
//
//if ($server_name == 'www.annisisi.com') {
//    include CONF . '/route/photo.php';
//}