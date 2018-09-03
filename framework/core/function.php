<?php

function config($key, $name = 'config', $default = '' )
{
    if (!is_file( CONF . '/' . $name . '.php')) {
         return $default;
    }

    $arr = include CONF . '/' . $name . '.php';

    return isset($arr[$key]) ? $arr[$key] : $default;

}

function debug($message, $content = [])
{
    $instance = FirePHP::getInstance(true);
    call_user_func_array(array($instance, 'log'), [$content,$message]);
}


function is_login()
{
    $value = md5("admininfo");
    $logindata = $_COOKIE;
    if (!isset($logindata["logindata"]) && $logindata["logindata"] != $value) {
        Header("Location: login");
        exit;
    }
}

class INPUT
{
    public static function getDate($key = null, $deful = null)
    {
        if (is_null($key)) {
            return $deful;
        }

        if (!isset($_REQUEST[$key])) {
            return $deful;
        }
        return $_REQUEST[$key];
    }

}
