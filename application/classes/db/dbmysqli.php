<?php 
namespace app\classes\db;
use app\classes\Singleton;
use mysqli;

class DbMysqli extends A_Db implements Db
{
    
    use Singleton;

    private function __construct()
    {
        $param = require $_SERVER['DOCUMENT_ROOT'] . '/config/configDb.php';
        
        $this->connect = new mysqli(
            $param['host'],
            $param['user'],
            $param['password'],
            $param['db_name']
        );
    }
}