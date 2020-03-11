<?php 
 namespace app\classes\db;

 abstract class A_Db
 {
    protected $connect;

    private function __clone()
    {
        
    }

    /**
     * @return object
     */
    public function Connect()
    {
        return $this->connect;
    }

    /**
     * @param string $query
     * @return array $result or boolean
     */
    public function ExecuteQuery($query)
    {
        $result = $this->connect->query($query);
        if ($result) {
            return $result;
        } else {
            return false;
        }
    }
 }