<?php

namespace app\classes\cart;

use app\classes\db\Db;
use app\classes\db\DbMysqli;
use app\classes\Product;
use app\classes\Singleton;

class Cart extends A_Cart
{

	use Singleton;

	private function __construct()
	{
		$this->user = $_SESSION['user_id'];
	}

	private function __clone()
	{
	}

	/**
	 * Передает данные из сессии в корзину: 
	 * $this->cart массив значений, где ключ - id продукта, а значение - количество; $this->count_in_cart - общее количество товарных позиций в корзине; $this->user - идентификатор сессии
	 */
	public function SetCart()
	{
		$this->cart = !empty($_SESSION['cart']) ? $_SESSION['cart'] : null;
		$this->count_in_cart =  !empty($_SESSION['cart']) ? count($_SESSION['cart']) : 0;
		$this->user =  isset($_SESSION['user_id']) ? $_SESSION['user_id'] : null;
		return true;
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
	{
		$this->SetCart();
		$data = [
			'cart' => $this->cart,
			'count' => $this->count_in_cart,
			'user' => $this->user,
			'total_price' => self::GetTotalPrice()
		];
		return $data;
	}
	/**
	 * Возвращает общую сумму корзины
	 * @return int|float
	 */
	static public function GetTotalPrice()
	{
		$result = 0;
		$db = DbMysqli::GetInstance();
		if (!empty($_SESSION['cart'])) {
			foreach ($_SESSION['cart'] as $k => $v) {
				$product = Product::GetProduct($k, $db);
				$price = $product['price'];
				$result += $v * $price;
			}
		}
		return $result;
	}

	/**
	 * Возвращает массив продуктов, содержащихся в базе данных
	 * @param Db $db подключение к базе данных 
	 * @return array
	 */
	public function GetProducts(Db $db)
	{
		$data['products'] = [];
		if (!empty($_SESSION['cart'])) {
			foreach ($_SESSION['cart'] as $k => $v) {
				$result['product'] = Product::GetProduct($k, $db);
				$result['count'] = $v;
				array_push($data['products'], $result);
			}
			$data['total_price'] = Cart::GetTotalPrice();
		}
		return $data;
	}

	/**
	 * Сохраняет корзину в базу данных
	 * @param array $cart массив данных, полученный при помощи метода GetCart()
	 * ($data = [
	 *		'cart' => $this->cart,
	 *		'count' => $this->count_in_cart,
	 *		'user' => $this->user,
	 *		'total_price' => self::GetTotalPrice()
	 * 	]);
	 * Проверяет, есть ли в базе данных корзина с user_id=user; 
	 * Если есть - обновляем ее; если нет - создаем.
	 * @return array корзина
	 */
	public function SaveCart($cart, Db $db)
	{
		extract($cart);
		$order_list = json_encode($cart);
		$checkUser = $db->ExecuteQuery("SELECT user_id FROM cart WHERE user_id='$user'");
		if ($checkUser->num_rows) {
			$query = "UPDATE cart SET  order_list='$order_list',  total_price='$total_price', total_quantity='$count' WHERE user_id='$user'";
		} else {
			$query = "INSERT INTO cart ( user_id, order_list,  total_price, total_quantity ) VALUES ('$user','$order_list','$total_price','$count')";
		}
		$result = $db->ExecuteQuery($query);
		return $result;
	}

	/**
	 * Возвращает корзину по идентификатору сессии
	 * (находит ее в базе данных, загружает в сессию и в объект Cart)
	 * @param int $user_id идентификатор сессии
	 * @param Db $db подключение к базе данных
	 * @return array $cart корзина
	 */
	public function GetUsersCart(int $user_id, Db $db)
	{
		$query = "SELECT * FROM cart WHERE user_id='$user_id'";
		$cart = $db->ExecuteQuery($query)->fetch_assoc();
		if ($cart) {
			if ($cart['order_list'] != 'null') {
				$order_list = json_decode($cart['order_list'],true);
				foreach ($order_list as $k => $v) {
					$_SESSION['cart'][$k] = $v;
				}
				$this->SetCart();
			}
		}
		return $cart;
	}
}
