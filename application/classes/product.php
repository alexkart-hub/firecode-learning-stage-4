<?php 
namespace app\classes;

use app\classes\db\Db;

class Product
 {
     static public function GetCategorys( Db $db )
     {
        $result = $db->ExecuteQuery( "SELECT * FROM sections" );
        if($result){
            foreach($result as $k=>$v){
                $data[$k] = $v;
            }
            return $data;
        } else {
            return false;
        }
     }
     static public function GetCategoryById( Db $db, $id )
     {
        $result = $db->ExecuteQuery( "SELECT * FROM sections WHERE id='$id'" );
        if ($result->num_rows == 1) {
            $row = $result->fetch_assoc();
            foreach ($row as $key => $vol) {
                $data[$key] = $vol;
            }
            $result->free();
            return $data;
        } else {
            return false;
        }
     }
     static function GetListCategories($categories)
	{ 
		$category_pages = [];
		foreach($categories as $v){
			array_push($category_pages, translit('Корм '.$v['name']));
		}
		return $category_pages;
	}


 }