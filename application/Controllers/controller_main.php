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

		switch ($index1){
			case 'korm':  $layout = 'main';break;
			case 'parser': $layout = 'parser'; break;
			default : $layout = '404'; break;
		}
		$this->view->generate($layout.'_view.php', 'template_view.php', $data);
	}
}