<?php
class Request{
	public $params;
	
	public function Request(){
		$uri = $_SERVER['REQUEST_URI'];
		$phpSelf = $_SERVER['PHP_SELF'];
		$queryStr = $_SERVER['QUERY_STRING'];	
		parse_str($queryStr, $this->params);
		if(!isset($this->params['c'])){
			$this->params['c'] = 'Index';
		}else{
			$this->params['c'] = ucfirst($this->params['c']);
		}
		if(!isset($this->params['a'])){
			$this->params['a'] = 'index';
		}
		
	}
	
		
}