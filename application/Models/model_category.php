<?php

namespace app\models;

use app\classes\db\DbMysqli;
use app\core\Model;

class Model_Category extends Model
{
    public function getData()
    {
        $data = [];
        $data['db'] = DbMysqli::GetInstance();
        // debug($data);
        return $data;
    }
}