<?php
class IndexController extends Controller{
	
	public function index(){
		$arr = array('test1', 'test2', 'test3');
		$arr = array_splice($arr, 1, -1);
		pr($arr);die;
		$data = $this->UserModel->allUsers();
		$this->set('data', $data);		
		$this->display();
	}
	
	public function test(){
		echo 'test';
		
		$this->display();
	}
}