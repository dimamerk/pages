<?php

namespace pagescms\controller;

use pagescms\request\Request;

abstract class Controller{

	protected $request;
	private $mainTemplate = 'main';
	protected $fields = [];

	abstract function actionIndex();

	public function init(Request $request){
		$this->request = $request;
		$actionName = $request->getActionName();
		if (empty($actionName)){
			$actionName = 'index';
		}
		$method = 'action'.ucfirst($actionName);
		if (method_exists($this, $method)){
			$this->$method();
		} else {
			throw new \Exception('Метод '.ucfirst($actionName).' не найден');
		}		
	}

	public function render($view,array $fieldsArray = []){
		$mainFileName = 'views/'.$this->mainTemplate.'.php';
		$viewFileName = 'views/'.$view.'.php';

		if (file_exists($viewFileName)){
			ob_start();
			include_once($viewFileName);
			$content = ob_get_clean();
		} else {
			throw new \Exception('Вид '.$view.' не найден');
		}

		if (file_exists($mainFileName)){			
			include_once($mainFileName);
		} else {
			throw new \Exception('Шаблон '.$this->mainTemplate.' не найден');
		}
	}

	public function redirect($url = '?q=site'){
 		header('Location: '.$url);
	}

	public function setField($key,$value){
		$this->fields[$key] = $value;
	}

	public function getField($key){
		if (isset($this->fields[$key])){
			return $this->fields[$key];
		}
	}

}

?>