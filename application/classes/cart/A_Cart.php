<?php 
namespace app\classes\cart;

use app\classes\db\Db;
use app\classes\db\DbMysqli;

abstract class A_Cart
{
	private $сart;
	private $count_in_cart;
	private $total_price;
	private $user;

	/**
	 * @param int $id id продукта, добавляемого в корзину
	 * @param int $count количество добавляемого продукта ( по умолчанию $count=1 )
	 * @return array корзина
	 */
	function AddToCart( int $id, $count = 0 )
	{
		$_SESSION['cart'][$id] = $_SESSION['cart'][$id] + $count;
		$result = $this->SaveCart($this->GetCart(), DbMysqli::GetInstance());
		return $result;
	}

	/**
	 * @param int $id id продукта, который удаляется из корзины
	 * @return array корзина
	 */
	function DeleteFromCart(int $id)
	{
		unset($_SESSION['cart'][$id]);
		$this->SaveCart($this->GetCart(), DbMysqli::GetInstance());
	}

	/**
	 * Очищает корзину
	 * @return boolean true
	 */
	function ClearCart()
	{
		$_SESSION['cart'] = null;
		$result = $this->SaveCart($this->GetCart(), DbMysqli::GetInstance());
		return true;
	}

	/**
	 * Стартует сессию
	 * @param int $id Идентификатор сессии
	 * @return boolean true
	 */
	function SessionStart(int $id = 1000)
	{
		session_start();
		if ( empty($_SESSION['user_id']) ){
			$_SESSION['user_id'] = $id;
		}
		return true;
	}

	/**
	 * Останавливает сессию
	 * (используется для отладки)
	 */
	function SessionStop()
	{
		$_SESSION['user_id'] = "";
		session_destroy();
	}

	public function SaveCart($cart, Db $db)
	{
	}

	/**
	 * Выполняет SetCart(), после чего возвращает массив данных
	 * $data = [
	 *		'cart' => $this->cart,
	 *		'count' => $this->count_in_cart,
	 *		'user' => $this->user,
	 *		'total_price' => self::GetTotalPrice()
	 * 	];
	 * @return array 
	 */
	public function GetCart()
	{}
}