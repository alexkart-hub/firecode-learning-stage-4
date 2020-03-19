<?php 
namespace app\classes\cart;

use app\classes\db\Db;
use app\classes\db\DbMysqli;
use app\classes\Singleton;

abstract class A_Cart
{
	private $сart;
	private $count_in_cart;
	private $total_price;
	private $user;

	use Singleton;

	function AddToCart($id, $count = 0)
	{
		$_SESSION['cart'][$id] = $_SESSION['cart'][$id] + $count;
		
		
		return $this->SaveCart($this->GetCart(), DbMysqli::GetInstance());
	
	}

	function DeleteFromCart($id)
	{
		unset($_SESSION['cart'][$id]);
		$this->SaveCart($this->GetCart(), DbMysqli::GetInstance());
	}

	function ClearCart()
	{
		$_SESSION['cart'] = null;
		$this->SaveCart($this->GetCart(), DbMysqli::GetInstance());
	}

	function SessionStart($id = 1000)
	{
		session_start();
		if ( empty($_SESSION['user_id']) ){
			$_SESSION['user_id'] = $id;
		$db = DbMysqli::GetInstance();
		// $ip = $_SERVER['REMOTE_ADDR'];
		}
		return true;
	}

	function SessionStop()
	{
		// $_SESSION['user_id'] = "";
		// $_SESSION['cart'] = null;
		session_destroy();
	}

	public function SaveCart($cart, Db $db)
	{
	}

	public function GetCart()
	{
	}
}