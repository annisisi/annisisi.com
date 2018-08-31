<?php
namespace application\models\Dao;

use application\models\Impl\IndexImpl;

class Index extends IndexImpl
{

    public function index()
    {

        $serach = [
            ['state','=','1'],
            ['index_state','=','1'],
        ];
        $lists = $this->lists($serach,1, 20, 'img,id,title','created_at desc');

        return $lists;
    }

    public function adminindex()
    {

        $serach = [
            ['state','=','1'],
            ['index_state','=','1'],
        ];
        $lists = $this->lists($serach,1, 20);

        return $lists;
    }

    public function work()
    {

        $serach = [
            ['state','=','1'],
        ];
        $lists = $this->lists($serach,1, 20, 'img,id,title','created_at desc');

        return $lists;
    }

    public function edit($serach)
    {
        $serach['updated_at'] = date('Y-m-d H:i:s');
        $serach['created_at'] = date('Y-m-d H:i:s');
        $lists = $this->create($serach);
        return $lists;
    }

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
        $data['lists'] = $lists;
        return $data;
    }
}