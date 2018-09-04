<?php
namespace application\models\Dao;

use application\models\Impl\AboutImpl;

class About extends AboutImpl
{

    public function index()
    {

    }

    public function about()
    {
        $serach = [
            ['type','=','about'],
            ['state','=','1'],
        ];
        $lists = $this->one($serach);
        return $lists;
    }

    public function contact()
    {
        $serach = [
            ['type','=','contact'],
            ['state','=','1'],
        ];
        $lists = $this->one($serach);
        return $lists;
    }

    public function getDate($type)
    {
        $serach = [
            ['type','=',$type],
            ['state','=','1'],
        ];
        $lists = $this->one($serach);
        return $lists[0];
    }

    public function updateData($id, $attributes)
    {
        $serach = [
            ['id','=',$id],
        ];
        $attributes['updated_at'] = date('Y-m-d H:i:s');
        $lists = $this->updata($serach, $attributes);
        return $lists;
    }
}