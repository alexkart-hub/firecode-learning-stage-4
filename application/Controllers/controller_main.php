<?php

namespace app\controllers;

use app\core\Controller;
use app\core\Route;
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
		// echo $index1.'   '.$index2;
		$data = $this->model->getData();
		
			 $layout = 'main';
			
		$this->view->generate($layout.'_view.php', 'template_view.php', $data);
	}
}