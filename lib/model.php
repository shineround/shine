<?php
class Model{
	
	private $_db;
	protected $_tbName;
	const SELECT = 'SELECT';
	
	public function __construct(){
		$this->_db = $GLOBALS['db'];
		$this->_tbName = Config::read('db_prefix') . $this->_tbName;
	}
	
	public function find($arr){
		$conditions = $arr['conditions'];
		$fields = $arr['fields'];
		if(!$conditions) $conditions[1] = 1;
		if(!$fields) $fields[] = '*';
		$conditionStr = '';
		foreach($conditions as $k => $v){
			if(is_array($v)){
				$conditionStr .= ' ' . $k . ' IN( ' . implode(',', $v) . ') AND';
			}else{
				$v = str_replace(' ', '', $v);
				if(in_array(substr($v, 0, 1), array('>', '<', '>=', '<=', '!='))){
					$conditionStr .= ' ' . $k . $v . ' AND';
				}else{
					$conditionStr .= ' ' . $k . '=' . $v . ' AND';
				}
				
			}
			
		}
		$conditionStr = rtrim($conditionStr, 'AND');
		
		$sql = self::SELECT . ' ' . implode(',', $fields) . ' FROM ' . $this->_tbName . ' ' . 'where' . $conditionStr;
		
		$tmp = mysql_query($sql);
		
		$data = array();
		while($row = mysql_fetch_assoc($tmp)){
			$data[] = $row;
		}
		
		return $data;
	}
}