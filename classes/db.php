<?php

namespace pagescms\db;

use pagescms\config\Config;

class DB{
		
	private static $DBH;

	private function __construct(){}

	public static function getInstance(){
		if (empty(self::$DBH)){
			self::$DBH = new \PDO(Config::$dbDSN, Config::$dbUser, Config::$dbPass); 
			self::$DBH->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
		}
		return self::$DBH;
	}
}

?>