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

	function action($index1, $index2)
	{
		// echo $index1.'   '.$index2;
		$data = $this->model->getData();
		$data += ['index1' => $index1];
		$data += ['index2' => $index2];

		if ($index1 != 'korm' && $index1 != '404') {
			Route::ErrorPage404();
		} else {
			$this->view->generate('main_view.php', 'template_view.php', $data);
		}
	}
}