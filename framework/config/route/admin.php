<?php
return [
    'GET' => [
        'index' => 'Index@index',
        'login' => 'User@login',
        'edit' => 'Index@edit',
        'create' => 'Index@create',
        'update' => 'Index@update',
        'delete' => 'About@delete',
        'imglist' => 'Img@index',
        'img/upload' => 'Img@upload',
    ],
    'POST' => [
        'login' => 'User@logindata',
        'edit' => 'Index@editdata',
        'img/delete' => 'Img@delete',
        'img/upload' => 'Img@uploaddata',
    ],
];