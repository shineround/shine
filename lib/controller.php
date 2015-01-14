<?php
include LIB_PATH . 'model.php';
define('VIEW_PATH', ROOT_PATH . 'view/');
define('MODEL_PATH', ROOT_PATH . 'model/');
class Controller{
	
	private $_controller;
	private $_action;
	private $_setParams;
	
	public function __construct($r){
		$this->_controller = $r->params['c'];
		$this->_action = $r->params['a'];
	}
	
	public function __get($property){
		$isModel = substr($property, -5, 5) == 'Model';
		if($isModel){
			$modelName = str_replace('Model', '', $property);
			
			return $this->loadModel($modelName);
		}
	}
	
	public function loadModel($m){
		if(file_exists(MODEL_PATH . $m . '.class.php')){
			include_once MODEL_PATH . $m . '.class.php';
			$m .= 'Model';
			return new $m();
		}else{
			throw new Exception('数据模型' . $m . '不存在');
		}
	}
	
	public function display(){
		$args = func_get_args();
		$tplName = isset($args[0]) ? $args[0] : $this->_action;
		$tplFile = VIEW_PATH . strtolower($this->_controller) . '/' . $tplName . '.php';
		if(!file_exists($tplFile)){
			throw new Exception('模板文件不存在');
		}
		ob_clean();
		ob_start();
		extract($this->_setParams);
		include $tplFile;
		ob_end_flush();
		exit();
	}
	
	public function set($key, $val){
		$this->_setParams[$key] = $val;
	}
	
}