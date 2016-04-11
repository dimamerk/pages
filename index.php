<?php

	namespace pagescms;	

	require_once('./classes/config.php'); //Настройки подключения к БД
	require_once('./classes/db.php');
	require_once('./classes/request.php');
	require_once('./classes/factory.php');
	require_once('./classes/controller.php');
	require_once('./classes/model.php');
	require_once('./classes/widget.php');

	use pagescms\request\Request;
	use pagescms\factory\Factory;

	class Main{

		public static function start(){
			$request = new Request;
			$controller = Factory::getController($request->getControllerName());
			$controller->init($request);
		}
	}

	try {
		Main::start();
	} catch (\Exception $e){
		$content = $e->__toString();
		include_once('views/error.php');
	}

?>