<?php
include LIB_PATH . 'controller.php';
define('CONTROLLER_PATH', ROOT_PATH . 'controller/');
class Route{

	public function __construct(Request $r){
		if(file_exists(CONTROLLER_PATH . $r->params['c'] . '.class.php')){
			include CONTROLLER_PATH . $r->params['c'] . '.class.php';
			$rController = $r->params['c'] . 'Controller';
			$controller = new $rController($r);
			
		}else{
			throw new Exception('控制器' . $r->params['c'] . '不存在');
		}
		
		
		
		$action = $r->params['a'];
		if(method_exists($controller, $action)){
			$controller->$action();
		}else{
			throw new Exception('方法' . $action . '不存在');
		}
		
		
	}
}