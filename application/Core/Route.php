<?php

namespace app\core;

use app\classes\db\DbMysqli;
use app\classes\Product;

class Route
{
	static function start()
	{


		// контроллер и действие по умолчанию
		$controller_name = 'Main';
		$action_name = 'index';
		$index = '';

		$routes = explode('/', $_SERVER['REQUEST_URI']);
		// debug($_POST);

		// получаем имя контроллера
		if (!empty($routes[1])) {
			$controller_name = $routes[1];
			$get = explode( '?', $controller_name );
			if (isset($get[1])){
				$controller_name = $get[0];
			}
		}

		// получаем индекс
		if (!empty($routes[2])) {
			$action_name = $routes[2];
		}


		$category = self::GetCategory($controller_name);
		if ($category) {
			if ($action_name == 'index') {
				$name_category = $category;
				
				$controller_name = 'Category';
				$action_name = strtolower($controller_name);
				$index = 'name_category';
			} else {
				if (Product::GetProduct($action_name, DbMysqli::GetInstance())) {
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
		$categories = Product::GetCategorys(DbMysqli::GetInstance());
		foreach ($categories as $category) {
			if ($name == translit('Корм ' . $category['name'])) {
				return $category;
			}
		}
		return false;

		// if (in_array($name, Product::GetListCategories($categories))) {
		// 	return $name;
		// } else {
		// 	return false;
		// }
	}

	static public function GetProduct($product)
	{
		if ($product > 0 && $product < 10000) {
			return $product;
		} else {
			return false;
		}
	}
}
