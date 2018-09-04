<?php
return [
    'GET' => [
        'index' => 'Index@index',
        'login' => 'User@login',
        'edit' => 'Index@edit',
        'imglist' => 'Img@index',
        'img/upload' => 'Img@upload',
        'personal' => 'Per@getDate',
    ],
    'POST' => [
        'login' => 'User@loginData',
        'edit' => 'Index@editData',
        'img/delete' => 'Img@delete',
        'img/upload' => 'Img@uploadData',
        'delete' => 'Index@deleteDate',
        'personal' => 'Per@updateDate',
    ],
];