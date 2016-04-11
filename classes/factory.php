<?php

namespace pagescms\factory;

abstract class Factory{

	private static function makeObject($name,$type){

		$className = '\pagescms\\'.strtolower($type).'\\'.ucfirst($name.$type);

		if (!class_exists($className)){
			$fileName = strtolower($type).'s/'.strtolower($name.$type).'.php';
			if (file_exists($fileName)){
				require_once($fileName);
			}
		}

		if (class_exists($className)){
			$obj = new $className();
			return $obj;
		}

		throw new \Exception($type.' '.$name.' не найден');

	}

	public static function getController($controllerName = null){
		
		if ($controllerName == null){
			$controllerName = 'site';
		}

		return self::makeObject($controllerName,'Controller');

	}

	public static function getModel($modelName = null){

		if (empty($modelName)){
			throw new \Exception('Модель не задана');
		}

		return self::makeObject($modelName,'Model');

	}

	public static function getWidget($widgetName = null){

		if (empty($widgetName)){
			throw new \Exception('Виджет не задан');
		}

		return self::makeObject($widgetName,'Widget');

	}

}

?>