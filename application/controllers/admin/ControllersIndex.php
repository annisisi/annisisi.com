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
        $type = INPUT::getDate('type', '1');

        $lists = $this->client->adminIndex($page, $num, $type);

        $state_arr = [0 => '草稿', 1 => '展示', 2 => '隐藏', 3 => '删除' ];
        $index_state_arr = [0 => '不展示',  1 => '展示'];
        foreach ($lists['lists'] as &$value)
        {
            $value['state'] = $state_arr[$value['state']];
            $value['index_state'] = $index_state_arr[$value['index_state']];
        }

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
            $lists = $this->client->adminOne($id);
        }

        $data['img_lists'] = imglist();
        $data['lists'] = $lists;
        Share::ShowSucc(['tpl' => 'admin.edit','data' => $data], 'html');
    }

    //添加
    public function editData()
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
            $this->client->updateData($id, $serach);
        }

        echo '成功,3秒返回';
        header("refresh:3;url=http://" . HTTP_HOST . '/index');
    }

    public function deleteDate()
    {
        is_login();
        $id = INPUT::getDate('id', '0');
        if ($id <= 0) {
            echo '失败,3秒返回';
            header("refresh:3;url=http://" . HTTP_HOST . '/index');
        }
        $serach = [
            'state' => 3,
        ];
        $res = $this->client->updateData($id, $serach);
        if ($res === false) {
            echo '失败,3秒返回';
        } else {
            echo '成功,3秒返回';
        }
        header("refresh:3;url=http://" . HTTP_HOST . '/index');
    }


}

