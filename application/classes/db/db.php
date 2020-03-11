<?php 
namespace app\classes\db;

interface Db
{
    /**
     * @return obj Db
     */
    static public function GetInstance();

    /**
    * @return object
    */
    public function Connect();

    /**
    * @param string $query
    * @return array $result or boolean
    */
    public function ExecuteQuery($query);
}