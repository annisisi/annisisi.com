<?php
namespace framework\libraries;

class Application
{
    private $file_list = [
        'framework/core/function',
        'framework/core/init',
    ];

    private $control = '';

    private $action = '';

    private $list = '';

    public function run()
    {
        //加载文件
        foreach ($this->file_list as $value)
        {
            require_once BASE_PATH . '/' . $value . '.php';
            DEBUG && debug('include',[$value]);
        }

        //获取地址
        $this->route();

        //前置
        $this->after();

        //开始程序
        $this->start();

        //后置
        $this->before();


    }

    private function route()
    {


        //请求URI获取
        $uri = isset($_SERVER['REQUEST_URI']) ? $_SERVER['REQUEST_URI'] : '/';
        if ($pos = strpos($uri, '?')) {
            $uri = substr($uri, 0, $pos);
        }
        $uri = trim($uri, '/');  //去除字符串两边空格和其他字符

        //请求协议
        if (isset($_REQUEST['_method'])) {
            $method = $_REQUEST['_method'];
        } else {
            $method = isset($_SERVER['REQUEST_METHOD']) ? $_SERVER['REQUEST_METHOD'] : 'GET';
        }
        $method == 'patch' && $method = 'put';
        $method = strtoupper($method);


        //路由文件
        if (HTTP_HOST == 'www.annisisi.com') {
            $res = include CONF . '/route/photo.php';
            $this->list = 'home';
        } elseif (HTTP_HOST == 'admin.annisisi.com') {
            $res = include CONF . '/route/admin.php';
            $this->list = 'admin';
        } else {
            $res = include CONF . '/route/photo.php';
            $this->list = 'home';
        }

        //文件
        if (isset($res[$method][$uri])) {
            if (strpos($res[$method][$uri], '@')) {
                $arr = explode( '@', $res[$method][$uri]);
                $this->control = $arr[0];
                $this->action = $arr[1];
            } else {
                $this->control = 'Index';
                $this->action = 'index';
            }
        } else {
            $this->control = 'Index';
            $this->action = 'index';
        }

        DEBUG && debug('action',['list' => $this->list, 'control' => $this->control, 'action' => $this->action]);
    }

    private function after()
    {

    }

    private function before()
    {

    }

    private function start()
    {
        $class = '\application\controllers\\' . $this->list . '\Controllers' . $this->control;
        $action = $this->action;
        $controllers = new $class();
        $controllers->$action();
    }

}