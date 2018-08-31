<?php

/*
 * 自动加载
 *
 */


function autoload($class)
{
    $file = $class . '.php';

    $file = str_replace('\\', '/', $file);
    if (is_file(BASE_PATH . '/' . $file)) {
        require_once BASE_PATH . '/' . $file;
        //DEBUG && debug('autoload-suc',[$file]);
    } else {
        DEBUG && debug('autoload-false',[$file]);
        die('文件不存在');
    }
}


spl_autoload_register('autoload');