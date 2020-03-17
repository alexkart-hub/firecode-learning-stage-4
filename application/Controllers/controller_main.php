<?php

namespace app\controllers;

use app\classes\db\DbMysqli;
use app\classes\Product;
use app\core\Controller;
use app\core\View;
use app\models\Model_Main;

class Controller_Main extends Controller
{
	public function __construct()
	{
		$this->model = new Model_Main;
		$this->view = new View;
	}

	function action_index()
	{
		$db = DbMysqli::GetInstance();
		$data = $this->model->getData();
		if(!empty($_POST)){
			$category = Product::GetCategoryById( $db, $_POST['id'] );
			header('Location: '.translit('Корм '.$category['name']));
			die();
		} 
			 $layout = 'main';
			
		$this->view->generate($layout.'_view.php', 'template_view.php', $data);
	}
}