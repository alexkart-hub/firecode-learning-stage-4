<?php

namespace app\models;

use app\classes\db\DbMysqli;
use app\core\Model;

class Model_Cart extends Model
{
    public function getData()
    {
        $data = [];
        $data['db'] = DbMysqli::GetInstance();
        // debug($data);
        return $data;
    }
}
