<?php

class Mysql{
	
	private $_conn;
	
	public function connect(){
		$host = Config::read('host');
		$user = Config::read('user');
		$pwd = Config::read('pwd');
		$this->_conn = mysql_connect($host, $user, $pwd);
		mysql_select_db(Config::read('db_name'), $this->_conn);
		mysql_query('SET NAMES UTF8');
	}
	
}