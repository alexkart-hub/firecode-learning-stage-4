<?php 

namespace app\core;

class Controller {
	
	public $model;
	public $view;
	
	function __construct()
	{
		$this->view = new View();
	}
	
	function action($index1, $index2)
	{
	}
}