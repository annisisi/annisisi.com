<?php
namespace application\controllers\admin;

use INPUT;
use framework\libraries\Share;
use application\models\Dao\Index;

class ControllersIndex
{

    private $client = NULL;

    public function __construct()
    {
        $this->client = new Index();
    }


    //主页
    public function index()
    {
        is_login();
        $page = INPUT::getDate('page', '1');
        $num = INPUT::getDate('num', '20');

        $lists = $this->client->adminindex($page, $num);
        Share::ShowSucc(['tpl' => 'admin.index','data' => $lists], 'html');
    }


    //编辑页
    public function edit()
    {
        is_login();
        $id = INPUT::getDate('id', '0');

        if ($id <= 0) {
            $lists = [];
        } else {
            $lists = $this->client->adminone($id);
        }

        Share::ShowSucc(['tpl' => 'admin.edit','data' => $lists], 'html');
    }

    //添加
    public function editdata()
    {
        is_login();
        $state = INPUT::getDate('state', '0');
        $index_state = INPUT::getDate('index_state', '0');
        $text = INPUT::getDate('text', '');
        $title = INPUT::getDate('title', '');
        $label = INPUT::getDate('label', '');
        $img = INPUT::getDate('img', '');
        $id = INPUT::getDate('id', '0');

        $serach = [
            'state' => $state,
            'index_state' => $index_state,
            'text' => $text,
            'img' => $img,
            'title' => $title,
            'label' => $label,
        ];

        if ($id <= 0) {
            $this->client->edit($serach);
        } else {
            $this->client->updatedata($id, $serach);
        }

        echo '成功,3秒返回';
        header("refresh:3;url=http://" . HTTP_HOST . '/index');
    }

}

