<?php

namespace app\controllers;

use app\classes\cart\Cart;
use app\classes\cart\LittleCart;
use app\classes\Pagination;
use app\core\Controller;
use app\core\Route;
use app\core\View;
use app\models\Model_Category;

class Controller_Category extends Controller
{
	public function __construct()
	{
		$this->model = new Model_Category;
		$this->view = new View;
	}

	public function action_category($category)
	{
		$get = empty($_GET['page']) ? 1 : $_GET['page'];
		$countProductsOnPage = 20;

		$data = $this->model->getData();
		$data['category'] = $category;
		$data['page']['number'] = intval($get); //номер страницы при пагинации
		$data['page']['count'] = Pagination::GetCountPages($category['id'], $countProductsOnPage, $this->model->db);
		if ($data['page']['number'] > $data['page']['count'] || $data['page']['number'] < 1 || !is_numeric($get)) {
			Route::ErrorPage404();
		}
		$params = [
			'id_category' => $category['id'],
			'number' => $data['page']['number'],
			'countProductsOnPage' => $countProductsOnPage
		];
		$data['products'] = Pagination::GetProducts($params, $this->model->db);

		$cart = Cart::GetInstance();
		$id = empty($_GET['id']) ? 0 : $_GET['id'];
		if($id){
			$cart->AddToCart($id,1);
		}
			// debug($cart->AddToCart($id,1));
	
		// $cart->SetCart();
		// debug($_SESSION);
		// debug($_GET);
		
		$layout = 'category';
		
		$this->view->generate($layout . '.php', 'template_view.php', $data);
	}
}