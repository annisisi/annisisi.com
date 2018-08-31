<?php
namespace framework\libraries;

use INPUT;


class Share
{
    public static function ShowSucc($data = [], $type = 'json')
    {

        try {
            self::message($data, $type);
        }
        catch(\Exception $e)
        {
            echo 'Message: ' .$e->getMessage();
        }

    }

    private static function message($data = [], $type = 'json')
    {
        if (empty($data)) {
            throw new \Exception("Data is Null!");
        }
        switch ($type)
        {
            case 'json':
                $out_rs = json_encode($data);
                $callback = INPUT::getDate('callback', '');
                if (!empty($callback)) {
                    header('Content-Type: text/javascript; charset=UTF-8');
                    echo "/**/{$callback}({$out_rs});";
                } else {
                    header('Content-Type: application/json; charset=UTF-8');
                    echo $out_rs;
                }
                break;
            case 'xml':
                break;
            case 'html':
                if (empty($data['tpl'])) {
                    throw new \Exception("Model name is Null!");
                }
                $arr = explode('.', $data['tpl']);
                if (!isset($arr[0]) && !isset($arr[1])) {
                    throw new \Exception("Model name is error!");
                }
                $pwd = VIEWS . '/' . $arr[0] . '/' . $arr[1] . '.php';

                if (!is_file($pwd)) {
                    throw new \Exception("ModelFile is Null!");
                }
                include $pwd;
                break;
            case 'html-smarty':
                if (empty($data['tpl'])) {
                    throw new \Exception("Model name is Null!");
                }
                $arr = explode('.', $data['tpl']);
                if (!isset($arr[0]) && !isset($arr[1])) {
                    throw new \Exception("Model name is error!");
                }
                $pwd = VIEWS . '/' . $arr[0] . '/' . $arr[1] . '.php';

                if (!is_file($pwd)) {
                    throw new \Exception("ModelFile is Null!");
                }

                $MySmarty = new MySmarty();
                foreach ($data['data'] as $key => $value)
                {
                    $MySmarty->assign($key, $value);
                }
                $MySmarty->display($pwd);
                break;
            default:
                throw new \Exception("Type is error!");
        }
        exit;
    }
}

