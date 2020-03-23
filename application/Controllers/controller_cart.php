<?php

namespace app\controllers;

use app\classes\cart\Cart;
use app\core\Controller;
use app\core\View;
use app\models\Model_Cart;

class Controller_Cart extends Controller
{
	public function __construct()
	{
		$this->model = new Model_Cart;
		$this->view = new View;
	}

	function action_index()
	{
		$data = $this->model->getData();
		foreach($data['categories'] as $category){
			$result[$category['id']] = $category['name']; 
		}
		$data['short_categories'] = $result;
		$cart = Cart::GetInstance();
		if(isset($_GET['clear'])){
			$cart->SessionStop();
			// $cart->ClearCart();
		}
		if(isset($_GET['delete_id'])){
			$cart->DeleteFromCart($_GET['delete_id']);
			$id = $_GET['delete_id'];

		}
		if(isset($_GET['id'])){
			$_SESSION['cart'][$_GET['id']] = $_GET['value'];
			$cart->SaveCart($cart->GetCart(), $this->model->db);
		}
		$data['cart'] = $cart->GetProducts($this->model->db);
		
			 $layout = 'cart';
			
		$this->view->generate($layout.'.php', 'template_view.php', $data);
	}
}