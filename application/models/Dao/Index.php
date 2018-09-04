<?php
namespace application\models\Dao;

use application\models\Impl\IndexImpl;

class Index extends IndexImpl
{

    //主页列表
    public function index()
    {

        $serach = [
            ['state','=','1'],
            ['index_state','=','1'],
        ];
        $lists = $this->lists($serach,1, 20, 'img,id,title','created_at desc');

        return $lists;
    }


    //后台列表
    public function adminIndex($page = 1, $num = 20, $type)
    {

        $serach = [
            ['state','=', $type],
        ];
        $lists = $this->lists($serach, $page, $num);

        return $lists;
    }

    //列表
    public function work()
    {

        $serach = [
            ['state','=','1'],
        ];
        $lists = $this->lists($serach,1, 20, 'img,id,title','created_at desc');

        return $lists;
    }

    //添加
    public function edit($serach)
    {
        $serach['updated_at'] = date('Y-m-d H:i:s');
        $serach['created_at'] = date('Y-m-d H:i:s');
        $lists = $this->create($serach);
        return $lists;
    }

    //添加
    public function updateData($id, $attributes)
    {
        $serach = [
            ['id','=',$id],
        ];
        $attributes['updated_at'] = date('Y-m-d H:i:s');
        $lists = $this->updata($serach, $attributes);
        return $lists;
    }

    //编辑页获取数据啊
    public function adminOne($id)
    {
        $serach = [
            ['id','=',$id],
        ];
        $lists = $this->one($serach);
        return $lists[0];
    }

    //获取详情页数据
    public function single($id)
    {
        $serach = [
            ['id','=',$id],
            ['state','=','1'],
        ];
        $lists = $this->one($serach);
        $data['single'] = $lists[0];
        $serach = [
            ['id','!=',$id],
            ['state','=','1'],
            ['index_state','=','1'],
        ];
        $lists = $this->lists($serach, 1,4);
        $data['lists'] = $lists['lists'];
        return $data;
    }

}