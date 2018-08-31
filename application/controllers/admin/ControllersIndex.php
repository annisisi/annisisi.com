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
        $list = $this->client->adminindex();
        Share::ShowSucc(['tpl' => 'admin.index','data' => $list], 'html');
    }


    //编辑页
    public function edit()
    {
        is_login();
        Share::ShowSucc(['tpl' => 'admin.edit','data' => []], 'html');
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

        if (empty($text) || empty($title) || empty($label)) {
            return false;
        }

        $file = $_FILES['img'];
        $type_arr = ['image/png', 'image/jpg', 'image/jpeg', 'image/gif'];
        if (!in_array($file['type'], $type_arr)) {
            return false;
        }

        if ($file['size'] > 2097152) {
            return false;
        }

        $dir_path = UPLOADS;
        if (!is_dir($dir_path)) {
            mkdir($dir_path, 0755, true);
        }

        $file_path = $dir_path . '/' . $file['name'];

        if (!move_uploaded_file($file['tmp_name'], $file_path)) {
            return false;
        }
        $img = 'http://www.annisisi.com/uploads/'. $file['name'];

        $serach = [
            'state' => $state,
            'index_state' => $index_state,
            'text' => $text,
            'img' => $img,
            'title' => $title,
            'label' => $label,
        ];

        $this->client->edit($serach);
        Share::ShowSucc(['tpl' => 'home.single','data' => []], 'html');
    }
}

