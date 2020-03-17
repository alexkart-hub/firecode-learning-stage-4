<?php 
namespace app\classes;

use app\classes\db\Db;

class Pagination
{
	static public function GetCountPages( $id_category, $countOnPage, Db $db )
	{
		$count_products = $db->ExecuteQuery("SELECT COUNT(*) as count FROM products WHERE id_section='$id_category'")->fetch_assoc();
		return ceil(intval($count_products['count'])/$countOnPage);
	}

	static public function GetProducts( $page, Db $db )
	{
		extract($page);
		$start = ($number-1) * $countProductsOnPage;
		$query = "SELECT * FROM products WHERE id_section='$id_category' LIMIT $start,$countProductsOnPage";
		$products = $db->ExecuteQuery($query);
		foreach($products as $k=>$v){
			$result[$k] = $v;
		}
		return $result;
	}
}