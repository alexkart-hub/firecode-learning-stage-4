<?php 
namespace app\classes;

use app\classes\db\Db;

class Pagination
{
	/**
	 * Возвращает количество страниц для пагинации
	 * @param int $id_category идентификатор категории товаров, для которой вычисляется количество страниц
	 * @param int $countOnPage количество товаров, отображаемых на одной странице
	 * @param Db $db подключение к базе данных
	 * @return int количество страниц
	 */
	static public function GetCountPages( int $id_category, int $countOnPage, Db $db )
	{
		$count_products = $db->ExecuteQuery("SELECT COUNT(*) as count FROM products WHERE id_section='$id_category'")->fetch_assoc();
		return ceil(intval($count_products['count'])/$countOnPage);
	}

	/**
	 * Возвращает массив продуктов, которые будут размещены на странице при пагинации
	 * @param array $page 
	 * ( $page = [
	 *		'id_category' => 'идентификатор категории',
	 *		'number' => 'номер страницы',
	 *		'countProductsOnPage' => 'количество товаров на странице'
	 *	] );
	 * @param Db $db подключение к базе данных
	 * @return array массив продуктов
	 */
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