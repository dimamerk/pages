<?php

namespace pagescms\request;

class Request{

	private $getParams = [];
	private $postParams = [];
	private $controller = null;
	private $action = null;

	private function parseArray(array $array){
		$ret = [];
		foreach ($array as $key => $value) {
			if ($key != 'q'){
				$ret[$key] = $value;
			} else {
				list($controller,$action) = explode('/',$value);
				if (!empty($controller)){
					$this->controller = $controller;
				}
				if (!empty($action)){
					$this->action = $action;
				}				
			}
		}
		return $ret;
	}

	public function __construct(){
		$this->getParams = $this->parseArray($_GET);
		$this->postParams = $this->parseArray($_POST);
	}

	public function get(){
		return $this->getParams;
	}

	public function post(){
		return $this->postParams;
	}

	public function all(){
		return array_merge($this->getParams,$this->postParams);
	}

	public function getControllerName(){
		return $this->controller;
	}

	public function getActionName(){
		return $this->action;
	}

	public function getValue($key){
		if (isset($this->getParams[$key])){
			return $this->getParams[$key];
		}
	}

}

?>