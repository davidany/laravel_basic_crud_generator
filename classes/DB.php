<?php

namespace Davidany\CodeGen;
use \PDO;

class DB
{
	private static $instance  = null;
	private static $instances = array();


	private function __construct()
	{
	}

	public static function getInstance($db_name = DB_NAME, $db_host = LOCALHOST, $db_user = DB_USERNAME, $db_pass = DB_PASSWORD)
	{
		//		echo $db_name . ' ' . $db_host;

		//		if($db_name == DB_NAME){
		self::$instances[$db_name] = '';

		echo '<br>';



		if (!self::$instances[$db_name]) {
			self::$instances[$db_name] = new PDO("" . DB_TYPE . ":host=" . $db_host . ";dbname=" . $db_name . "", $db_user, $db_pass);
			self::$instances[$db_name]->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

		}

		return self::$instances[$db_name];
		////		}else{
		//
		//			if (!self::$instance) {
		//				self::$instance = new PDO("" . DB_TYPE . ":host=" . $db_host . ";dbname=" . $db_name . "", $db_user, $db_pass);
		//				self::$instance->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		//			}
		//			return self::$instance;


	}


	private function __clone()
	{
	}
}
