<?php

namespace app\classes\cart;

use app\classes\db\Db;
use app\classes\db\DbMysqli;
use app\classes\Product;
use app\classes\Singleton;
use DateTime;

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

	public function SetCart()
	{
		$this->cart = !empty($_SESSION['cart']) ? $_SESSION['cart'] : null;
		$this->count_in_cart =  !empty($_SESSION['cart']) ? count($_SESSION['cart']) : 0;
		$this->user =  isset($_SESSION['user_id']) ? $_SESSION['user_id'] : null;
		return true;
	}

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
	public function GetProducts( Db $db )
	{
		$data['products'] = [];
		if (!empty($_SESSION['cart'])) {
			foreach ($_SESSION['cart'] as $k => $v) {
				$result['product'] = Product::GetProduct($k, $db);
				$result['count'] = $v;
				array_push($data['products'],$result);
			}
			$data['total_price'] = Cart::GetTotalPrice();
		}
		return $data;
	}

	public function SaveCart($cart, Db $db)
	{
		extract($cart);
		$order_list = json_encode($cart);
		$result = $db->ExecuteQuery("SELECT user_id FROM cart WHERE user_id='$user'");
		if($result->num_rows){
			$query = "UPDATE cart SET  order_list='$order_list',  total_price='$total_price', total_quantity='$count' WHERE user_id='$user'";
		} else {
			$query = "INSERT INTO cart ( user_id, order_list,  total_price, total_quantity ) VALUES ('$user','$order_list','$total_price','$count')";
		}
		$db->ExecuteQuery($query);
		return $query;
	}
}
