<?php

namespace app\core;

class Route
{
	static function start()
	{
		// контроллер и действие по умолчанию
		$controller_name = 'Main';
		$action_name = 'action';

		$routes = explode('/', $_SERVER['REQUEST_URI']);

		// получаем имя контроллера
		if (!empty($routes[1])) {
			$index1 = $routes[1];
		}

		// получаем индекс
		if (!empty($routes[2])) {
			$index2 = $routes[2];
		}

		if($index1 == '404'){
			$controller_name = $index1;
		}
		$controller_name = 'Controller_'.$controller_name;
		// подцепляем файл с классом модели (файла модели может и не быть)
		$model_name = 'Model_'.$controller_name;
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
			$controller->$action($index1, $index2);
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
}
