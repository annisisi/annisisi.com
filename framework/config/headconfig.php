<?php
$head = [
    'data' => [
        '主页管理' => [
            '关于我' => [
                'href' => '/personal?type=about'
            ],
            '联系我' => [
                'href' => '/personal?type=contact'
            ],
        ],

        '文章管理' => [
            '文章列表' => [
                'href' => '/index',
            ],
            '新增文章' => [
                'href' => '/edit',
            ],
            '已删除文章' => [
                'href' => '/index?type=3',
            ],
            '已保存草稿' => [
                'href' => '/index?type=0',
            ] ,
            '已隐藏' => [
                'href' => '/index?type=2',
            ] ,
        ],

        '图片管理' => [
            '图片列表' => [
                'href' => '/imglist',
            ],
            '上传图片' => [
                'href' => '/img/upload',
            ],
        ],

        '用户管理' => [
            '修改用户' => [
                'href' => ''
            ],
        ],
    ]

];

return $head;