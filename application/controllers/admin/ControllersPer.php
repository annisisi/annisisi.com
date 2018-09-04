<?php
namespace application\controllers\admin;

use INPUT;
use framework\libraries\Share;
use application\models\Dao\About;

class ControllersPer
{

    private $client = NULL;

    public function __construct()
    {
        $this->client = new About();
    }

    public function getDate()
    {
        is_login();
        $type = INPUT::getDate('type', 'about');
        $data = $this->client->getDate($type);
        Share::ShowSucc(['tpl' => 'admin.personal', 'data' => $data], 'html');
    }

    public function updateDate()
    {
        is_login();
        $state = INPUT::getDate('state', '0');
        $text = INPUT::getDate('text', '');
        $title = INPUT::getDate('title', '');
        $label = INPUT::getDate('label', '');
        $img = INPUT::getDate('img', '');
        $id = INPUT::getDate('id', '0');

        if($id <= 0) {
            echo '失败,3秒返回';
            header("refresh:3;url=http://" . HTTP_HOST . '/index');
        }

        $serach = [
            'state' => $state,
            'text' => $text,
            'img' => $img,
            'title' => $title,
            'label' => $label,
        ];

        $this->client->updateData($id, $serach);
        echo '成功,3秒返回';
        header("refresh:3;url=http://" . HTTP_HOST . '/index');
    }


}
