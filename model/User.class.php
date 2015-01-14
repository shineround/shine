<?php
class UserModel extends Model{
	public $_tbName = 'member';
	
	public function allUsers(){
		$conditions = array(
			'id' => array(5367, 2594),
		);
		$fields = array();
		
		$data = $this->find(array('conditions' => $conditions, 'fields' => $fields));
		
		return $data;
		
	}
}