<?php
class myException extends Exception{
	
	public function catchExc(){
		
		$msg = $this->getMessage();
		
		return $msg;
	}
}