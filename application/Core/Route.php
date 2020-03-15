<?php

namespace app\core;

class Route
{
	static function start()
	{


		// контроллер и действие по умолчанию
		$controller_name = 'Main';
		$action_name = 'index';
		$index = '';

		$routes = explode('/', $_SERVER['REQUEST_URI']);

		// получаем имя контроллера
		if (!empty($routes[1])) {
			$controller_name = $routes[1];
		}

		// получаем индекс
		if (!empty($routes[2])) {
			$action_name = $routes[2];
		}

		
		
		if(self::GetCategory($controller_name)){
			if( $action_name == 'index' ){
			$name_category = $controller_name;
			$controller_name = 'Category';
			$action_name = strtolower($controller_name);
			$index = 'name_category';
		} else {
			if( self::GetProduct($action_name) ){
				$name_product = [
					'name_category' => $controller_name,
					'id_product' => $action_name
				];
				$controller_name = 'Product';
				$action_name = strtolower($controller_name);
				$index = 'name_product';
			}
		}
		}
		// добавляем префиксы
		$model_name = 'Model_' . $controller_name;
		$controller_name = 'Controller_' . $controller_name;
		$action_name = 'action_' . $action_name;

		// подцепляем файл с классом модели (файла модели может и не быть)
		$model_name = 'Model_' . $controller_name;
		$model_file = strtolower($model_name) . '.php';
		$model_path = $_SERVER['DOCUMENT_ROOT'] . "/application/models/" . $model_file;
		if (file_exists($model_path)) {
			include $_SERVER['DOCUMENT_ROOT'] . "/application/models/" . $model_file;
		}

		// подцепляем файл с классом контроллера
		$controller_file = strtolower($controller_name) . '.php';
		$controller_path = $_SERVER['DOCUMENT_ROOT'] . "/application/controllers/" . $controller_file;
		if (file_exists($controller_path)) {
			include $_SERVER['DOCUMENT_ROOT'] . "/application/controllers/" . $controller_file;
		} else {
			/*
			правильно было бы кинуть здесь исключение,
			но для упрощения сразу сделаем редирект на страницу 404
			*/
			Route::ErrorPage404();
		}

		// создаем контроллер
		$controller_name = 'app\controllers\\' .  $controller_name;
		$controller = new $controller_name;
		$action = $action_name;

		if (method_exists($controller, $action)) {
			// вызываем действие контроллера
			$controller->$action($$index);
		} else {
			// здесь также разумнее было бы кинуть исключение
			Route::ErrorPage404();
		}
	}

	static function ErrorPage404()
	{
		$host = 'http://' . $_SERVER['HTTP_HOST'] . '/';
		header('HTTP/1.1 404 Not Found');
		header("Status: 404 Not Found");
		header('Location:' . $host . '404');
	}

	static function GetCategory(string $name)
	{
		$category_pages = include $_SERVER['DOCUMENT_ROOT'] . "/config/category_pages.php";
		if (in_array($name, $category_pages)) {
			return $name;
		} else {
			return false;
		}
	}

	static public function GetProduct(int $product)
	{
		if($product > 0 && $product < 1000){
			return $product;
		} else {
			return false;
		}
	}
}
