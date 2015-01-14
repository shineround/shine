<?php
define('CONFIG_PATH', ROOT_PATH . 'config/');
class Config{
	
	private static $_configs;
	
	private function __construct(){
		
	}
	
	private function __clone(){
		
	}
	
	public static function init(){
		self::$_configs = include CONFIG_PATH . 'db.conf.php';
		
		return new self();
	}
	
	public static function read($key){
		
		if(isset(self::$_configs[$key])){
			return self::$_configs[$key];
		}else{
			return false;
		}
	}
	
	public static function write($key, $val){
		self::$_configs[$key] = $val;
		
		return true;
	}
}