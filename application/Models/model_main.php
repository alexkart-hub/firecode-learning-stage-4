<?php

namespace app\models;

use app\core\Model;

class Model_Main extends Model
{
    public function getData()
    {
        $data = [];
        // $data = Color::GetAll(DbMysqli::GetInstance());
        // debug($data);
        return $data;
    }
}
