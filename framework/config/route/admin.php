<?php
return [
    'GET' => [
        'index' => 'Index@index',
        'login' => 'User@login',
        'edit' => 'Index@edit',
        'create' => 'Index@create',
        'update' => 'Index@update',
        'delete' => 'About@delete',
    ],
    'POST' => [
        'login' => 'User@logindata',
        'edit' => 'Index@editdata',
    ],
];