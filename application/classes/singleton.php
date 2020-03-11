<?php 
namespace app\classes;

trait Singleton
{
    static private $instance = null;

    static public function GetInstance()
    {
        if(self::$instance === null){
            self::$instance = new self();
        }
        return self::$instance;
    }
}