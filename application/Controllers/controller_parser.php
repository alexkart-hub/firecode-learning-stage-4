<?php

namespace app\controllers;

use app\core\Controller;
use app\core\View;

class Controller_Parser extends Controller
{
	public function __construct()
	{
		$this->view = new View;
	}

	function action_index()
	{
		
			 $layout = 'parser';
			
		$this->view->generate($layout.'.php', 'template_view.php');
	}
}