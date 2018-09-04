<?php
namespace application\controllers\home;

use framework\libraries\Share;
use application\models\Dao\About;

class ControllersAbout
{

    private $client = NULL;

    public function __construct()
    {
        $this->client = new About();
    }


    //主页
    public function about()
    {
        $data = $this->client->about();
        $list = $data[0];
        $list['label'] = explode(',', $list['label']);
        Share::ShowSucc(['tpl' => 'home.about','data' => $list], 'html');
    }


    //列表
    public function contact()
    {
        $list = $this->client->contact();
        Share::ShowSucc(['tpl' => 'home.contact','data' => $list[0]], 'html');
    }
}

