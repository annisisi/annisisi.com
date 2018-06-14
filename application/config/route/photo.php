<?php
if ($method == 'GET') {
    if ($uri == 'index') {
        require_once  CONTROLL . '/home/ControllersIndex.php';
        \application\controllers\home\ControllersIndex::index();
    }
} else if ($method == 'POST') {

} else if ($method == 'PUT') {

} else if ($method == 'DELETE') {

}