<?php
namespace application\controllers\admin;

use INPUT;
use framework\libraries\Share;
//use application\models\Dao\User;

class ControllersUser
{

    private $client = NULL;

    public function __construct()
    {
        //$this->client = new User();
    }


    //主页
    public function login()
    {
        is_login();
        //$list = $this->client->index();
        Share::ShowSucc(['tpl' => 'admin.login','data' => []], 'html');
    }


    //列表
    public function logindata()
    {
        is_login();
        $user = INPUT::getDate('user', '');
        $password = INPUT::getDate('password', '');

        if (empty($user) || empty($password)) {
            return false;
        }
        if ($user == 'admin' && $password == 'lianthony15') {
            $value = md5("admininfo");
            // 发送一个 24 小时候过期的 cookie
            setcookie("logindata", $value, time()+3600*24);
            Header("Location: index");
        } else {
            return false;
        }
    }

}
