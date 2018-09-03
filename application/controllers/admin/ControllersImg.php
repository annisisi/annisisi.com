<?php
namespace application\controllers\admin;

use INPUT;
use framework\libraries\Share;


class ControllersImg
{
    public function index()
    {
        is_login();
        $lists = [];
        $handler = opendir(UPLOADS);//当前目录中的文件夹下的文件夹
        while( ($filename = readdir($handler)) !== false ) {
            if ($filename != "." && $filename != ".." ) {
                if (stripos($filename, '.png') || stripos($filename, '.jpg') || stripos($filename, '.jpeg') || stripos($filename, '.gif')) {
                    $lists[] = $filename;
                }
            }
        }
        closedir($handler);

        Share::ShowSucc(['tpl' => 'admin.img','data' => $lists], 'html');

    }

    public function delete()
    {
        is_login();
        $name = INPUT::getDate('name', '');
        $file = UPLOADS . '/' . $name;
        if (@unlink($file)) {
            Header("Location: imglist");
            exit;
        } else {
            echo '删除失败,3秒返回';
            header("refresh:3;url=http://" . HTTP_HOST . '/imglist');
        }
        exit;
    }

    public function upload()
    {
        is_login();
        Share::ShowSucc(['tpl' => 'admin.imgupload','data' => []], 'html');
    }


    public function uploaddata()
    {
        is_login();
        $file = $_FILES['myfile'];
        $count = count($file['name']);

        $arr_file = [];
        $type_arr = ['image/png', 'image/jpg', 'image/jpeg', 'image/gif'];
        for ($i = 0; $i < $count; $i++)
        {
            if (!in_array($file['type'][$i], $type_arr)) {
                continue;
            }

            if ($file['size'][$i] > 2097152) {
                continue;
            }

            $dir_path = UPLOADS;
            if (!is_dir($dir_path)) {
                mkdir($dir_path, 0755, true);
            }

            $file_path = $dir_path . '/' . $file['name'][$i];

            if (!is_file($file_path)) {
                if (!move_uploaded_file($file['tmp_name'][$i], $file_path)) {
                    continue;
                }
            } else {
                continue;
            }

            $arr_file[] = $file['name'][$i];
        }

        if (count($arr_file) > 0) {
            foreach ($arr_file as $value)
            {
                echo $value . '--上传成功<br>';
            }
            echo '成功上传' . count($arr_file) . '张图片,3秒返回！';
        } else {
            echo '上传失败,3秒返回';
        }
        header("refresh:3;url=http://" . HTTP_HOST . '/imglist');
    }

}
