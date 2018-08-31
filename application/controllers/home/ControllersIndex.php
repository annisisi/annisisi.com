<?php
namespace application\controllers\home;

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
        $list = $this->client->index();
        Share::ShowSucc(['tpl' => 'home.index','data' => $list], 'html');
    }


    //列表
    public function work()
    {
        $list = $this->client->work();
        Share::ShowSucc(['tpl' => 'home.work','data' => $list], 'html');
    }

    public function single()
    {
        $id = INPUT::getDate('id', '0');

        if ($id <= 0 || !is_numeric($id)) {
            http_response_code(404);
            exit;
        }
        $data = $this->client->single($id);
        $data['single']['label'] = explode(',', $data['single']['label']);
        Share::ShowSucc(['tpl' => 'home.single','data' => $data], 'html');
    }
}

