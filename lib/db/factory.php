<?php
class dbFactory{

	
	public static function init(){
		$args = func_get_args();
		$type = $args[0] ? $args[0] : 'mysql';
		
		if(file_exists(LIB_PATH . 'db/' . $type . '.php')){
			include LIB_PATH . 'db/' . $type . '.php';
			$type = ucfirst($type);
			$db = new $type();
			return $db;
		}else{
			throw new Exception('不支持' . $type . '数据库');
		}
	}
}