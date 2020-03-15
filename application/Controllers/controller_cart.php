<?php

namespace app\controllers;

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
		// echo $index1.'   '.$index2;
		$data = $this->model->getData();
		
			 $layout = 'cart';
			
		$this->view->generate($layout.'.php', 'template_view.php', $data);
	}
}