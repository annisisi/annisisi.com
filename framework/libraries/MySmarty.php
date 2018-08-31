<?php
namespace framework\libraries;

class MySmarty
{

    //属性
    public static $vars;                        //保存要替换的标记和数据的内容
    public static $left_delimiter = '{*';        //左分隔符
    public static $right_delimiter = '*}';        //右分隔符
    //方法
    public static function assign($key,$value)
    {

        self::$vars[$key] = $value;
    }
    public static function display($file)     //file表示模板名
    {
        $str = file_get_contents($file);    //从模板中读取多有内容，并将内容放入$str中
        foreach (self::$vars as $key => $value) //$key 键名（模板标记） $value 值
        {

            $str = str_replace(self::$left_delimiter.$key.self::$right_delimiter, $value, $str);
        }
        echo $str;
        //file_put_contents('bak.html', $str);
    }
}
?>