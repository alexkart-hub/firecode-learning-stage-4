<?php 

namespace app\core;

class View
{
	//public $template_view; // здесь можно указать общий вид по умолчанию.
	
	function generate($content_view, $template_view, $data = null)
	{
		/*
		if(is_array($data)) {
			// преобразуем элементы массива в переменные
			extract($data);
		}
		*/
		
		include $_SERVER['DOCUMENT_ROOT'].'/public/template/'.$template_view;
	}
}