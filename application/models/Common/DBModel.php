<?php
namespace application\models\Common;

use PDO;

class DBModel
{
    private $handle = '';

    public $database = '';

    public $table = '';

    public $condition_str = '=|<|>|<=|>=|in|not in|or|!=|like|not like';

    public function __construct()
    {
        if (empty($this->handle)) {
            $this->handle = PDODB::gethandle($this->database);
        }
    }

    public function lists($serach, $page = 1, $num = 20, $str = '', $order = '', $group = '')
    {
        if (empty($str)) {
            $str = '*';
        }

        $wherestr = $this->handle->wherestr($serach);

        if (!empty($order)) {
            $order = 'ORDER BY ' . $order;
        }

        if (!empty($group)) {
            $order = 'GROUP BY ' . $order;
        }

        $sql = "SELECT  COUNT(*) as num FROM {$this->table} WHERE {$wherestr['str']} {$order} {$group} " ;

        $count = $this->handle->query($sql,$wherestr['value'], $this->database);

        if ($count[0]['num'] > 0) {
            $start = ($page - 1) * $num;
            $sql = "SELECT {$str} FROM {$this->table} WHERE {$wherestr['str']} {$order} {$group} LIMIT {$start},{$num}" ;
            $date['lists'] = $this->handle->query($sql,$wherestr['value'], $this->database);
            $date['other'] = [
                'count' => $count[0]['num'],
                'count_page' => ceil($count[0]['num'] / $num),
                'page' => $page,
                'num' => $num,
            ];
        } else {
            $date['lists'] = [];
            $date['other'] = [
                'count' => 0,
                'count_page' => 0,
                'page' => $page,
                'num' => $num,
            ];
        }



        return $date;
    }

    public function one($serach, $str = '', $order = '', $group = '')
    {
        if (empty($str)) {
            $str = '*';
        }

        $wherestr = $this->handle->wherestr($serach, $this->database);

        if (!empty($order)) {
            $order = ' ORDER BY ' . $order;
        }

        if (!empty($group)) {
            $order = ' GROUP BY ' . $order;
        }

        $sql = "SELECT {$str} FROM {$this->table} WHERE {$wherestr['str']} {$order} {$group} LIMIT 1" ;
        $date = $this->handle->query($sql,$wherestr['value'], $this->database);
        return $date;
    }

    public function create($serach)
    {
        $str_arr = [];
        $val_arr = [];
        foreach ($serach as $key => $value)
        {
            $str_arr[] = "`{$key}`";
            $val_arr[] = ":{$key}";
        }
        $str = implode(',', $str_arr);
        $val = implode(',', $val_arr);

        $sql = "INSERT INTO {$this->table} ({$str}) VALUES ({$val})";
        $date = $this->handle->query($sql, $serach, $this->database);

        return $date;
    }

    public function updata($serach, $attributes)
    {
        $wherestr = $this->handle->wherestr($serach);

        $str_arr = [];
        $val_arr = [];
        foreach ($attributes as $key => $value)
        {
            $str_arr[] = "{$key} = :{$key}";
            $val_arr[$key] = $value;
        }
        $str = implode(',', $str_arr);

        $sql = "UPDATE {$this->table} SET {$str} WHERE {$wherestr['str']}";
        $date = $this->handle->query($sql,$wherestr['value'] + $val_arr, $this->database);

        return $date;
    }

    public function delete($serach)
    {
        $wherestr = $this->handle->wherestr($serach);


        $sql = "DELETE FROM {$this->table} WHERE {$wherestr['str']}";
        $date = $this->handle->query($sql,$wherestr['value'], $this->database);

        return $date;
    }


}


class PDODB
{
    public static $link = [];

    private static $handle = [];

    private static $condition_str = '=|<|>|<=|>=|in|not in|or|!=|like|not like';

    private function  __construct($database)
    {
        $db = config($database, 'database');

        $dsn = "mysql:dbname={$db['dbname']};host={$db['host']};port={$db['port']}";
        $username = $db['username'];
        $password = $db['password'];
        try {
            self::$link[$database] = new PDO($dsn, $username, $password);
            DEBUG && debug('mysql-suc',[$dsn,$username,$password]);
        } catch(PDOException $e) {
            DEBUG && debug('mysql-false',[$dsn,$username,$password]);
            die('Could not connect to the database:<br/>' . $e);
        }
        self::$link[$database]->exec('set names ' . $db['char_set']);
    }

    private function __clone(){}

    static public function gethandle($database)
    {
        if (!isset(self::$handle[$database])) {
            self::$handle[$database] = new self($database);
        }
        return self::$handle[$database];
    }


    public function query($sql, $serach, $database, $db_select = 'slave')
    {
        if (stripos($sql, 'select') === false || $db_select == 'master') {
            $db_select_last = 'master';
        } else {
            $db_select_last = 'slave';
        }
        $query = self::$link[$database]->prepare($sql);
        DEBUG && debug('errorInfo',[self::$link[$database]->errorInfo()]);
        DEBUG && debug('query',[$sql]);
        $i = 1;
        foreach ($serach as $key => $value)
        {
            $query->bindValue(':' . $key , $value, self::$link[$database]::PARAM_STR);
            DEBUG && debug('bindParam',[':' . $key ,$value]);
            $i++;
        }
        $query->execute();
        DEBUG && debug('errorInfo',[$query->errorInfo()]);
        $result = $query->fetchAll();

        DEBUG && debug('errorInfo',[$query->errorInfo()]);

        //$query->debugDumpParams();
        return $result;
    }

    public function wherestr($serach)
    {
        $arr = [];
        $where_arr = [];
        foreach ($serach as $value)
        {
            if (is_array($value) && count($value) != 3) {
                return false;
            }
            if (strpos(self::$condition_str, $value[1]) === false) {
                    return false;
            }
            if ($value[1] == 'in' || $value[1] == 'not in') {
                $strarr = explode(',', $value[2]);
                foreach ($strarr as $k => &$val) {
                    $where_arr[$value[0] . $k] = $val;
                    $val = ':' . $value[0] . $k;
                }
                $str = implode(',', $strarr);
                $arr[]  = "`{$value[0]}` {$value[1]} (" . $str . ")" ;
            } else {
                $arr[] = "`{$value[0]}` {$value[1]} :{$value[0]} ";
                $where_arr[$value[0]] = $value[2];
            }


        }
        $where['str'] = implode(' AND ', $arr);
        $where['value'] = $where_arr;
        return $where;
    }
}

class MysqlDB
{
    public static $link = [];

    private static $handle = [];

    private static $condition_str = '=|<|>|<=|>=|in|not in|or|!=|like|not like';

    private function __construct($database)
    {
        $db = config($database, 'database');
        self::$link[$database] = mysqli_init();
        self::$link[$database]->options(MYSQLI_OPT_CONNECT_TIMEOUT, 2);//设置超时时间
        self::$link[$database]->real_connect($db['host'] . ':' . $db['port'], $db['username'], $db['password'], $db['dbname']);
        self::$link[$database]->query('set names ' . $db['char_set']);
        //return $link[$database];
    }


    private function __clone(){}

    public static function gethandle($database)
    {
        if (!isset(self::$handle[$database])) {
            self::$handle[$database] = new self($database);
        }
        return self::$handle[$database];
    }

    public function query($sql, $database, $db_select = 'slave')
    {
        if (stripos($sql, 'select') === false || $db_select == 'master') {
            $db_select_last = 'master';
        } else {
            $db_select_last = 'slave';
        }
        $query = self::$link[$database]->query($sql);
        if (is_bool($query)) {
            $res = $query;
        } else {
            $res = [];
            while ($row = $query->fetch_assoc()) {
                $res[] = $row;
            }
        }
        return $res;
    }

    public function wherestr($serach, $database)
    {
        $arr = [];
        foreach ($serach as $value)
        {
            if (is_array($value) && count($value) != 3) {
                return false;
            }
            if (strpos(self::$condition_str, $value[1]) === false) {
                return false;
            }
            if ($value[1] == 'in' || $value[1] == 'not in') {
                $strarr = explode(',', $value[2]);
                foreach ($strarr as &$val) {
                    $strarr = "'" . mysqli_real_escape_string(self::$link[$database], $val) . "'";
                }
                $str = implode(',', $strarr);
                $arr[]  = "`{$value[0]}` {$value[1]} (" . $str . ")" ;
            } else {
                $arr[] = "`{$value[0]}` {$value[1]} " .  mysqli_real_escape_string(self::$link[$database], $value[2]);
            }


        }
        $where = implode(' AND ', $arr);
        return $where;
    }
}



