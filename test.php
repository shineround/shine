<?php


class MQ{
	public static $client;
	private static $m_real;
	private static $m_front;
	private static $m_data = array();
	public static $memcacheObj;
	const QUEUE_MAX_NUM = 100000000;
	const QUEUE_FRONT_KEY = '_queue_item_front';
	const QUEUE_REAL_KEY = '_queue_item_real';
	public static function setupMq($conf) {
		self::$memcacheObj = new Memcache();
		
		
		self::$memcacheObj->connect($conf);
		
		self::$m_real = self::$memcacheObj->get( self::QUEUE_REAL_KEY);
		
		self::$m_front = self::$memcacheObj->get( self::QUEUE_FRONT_KEY);
		if (!isset(self::$m_real) || empty(self::$m_real)) {
			self::$m_real= 0;
		}
		if (!isset(self::$m_front) || empty(self::$m_front)) {
			self::$m_front = 0;
		}
		
		return self::$memcacheObj;
	}
	public static function add($queue, $data) {
		$result = false;
		if (self::$m_real < self::QUEUE_MAX_NUM) {
			
			if (self::$memcacheObj->add( $queue.self::$m_real, $data)) {
				self::mqRealChange();
				$result = true;
			}
		}
		
		return $result;
	}
	public static function get($key, $count) {
		$num = 0;
		for ($i=self::$m_front;$i<self::$m_front + $count;$i++) {
			if ($dataTmp = self::$memcacheObj->get( $key.$i)) {
				self::$m_data[] = $dataTmp;
				self::$memcacheObj->delete( $key.$i);
				$num++;
			}
		}
		if ($num>0) {
			self::mqFrontChange($num);
		}
		return self::$m_data;
	}
	private static function mqRealChange() {
		self::$memcacheObj->add( self::QUEUE_REAL_KEY, 0);
		
		self::$m_real = self::$memcacheObj->increment( self::QUEUE_REAL_KEY, 1);
		
	}
	
	private static function mqFrontChange($num) {
		self::$memcacheObj->add( self::QUEUE_FRONT_KEY, 0);
		self::$m_front = self::$memcacheObj->increment( self::QUEUE_FRONT_KEY, $num);
		
		
	}
	public static function mflush() {
		self::$memcacheObj->flush();
	}
	public static function Debug() {
		echo 'real:'.self::$m_real."<br>/r/n";
		echo 'front:'.self::$m_front."<br>/r/n";
		echo 'wait for process data:'.intval(self::$m_real - self::$m_front);
		echo "<br>/r/n";
		echo '<pre>';
		print_r(self::$m_data);
		print_r(self::$m_real);
		echo '<pre>';
	}
}
define('FLUSH_MQ',0);//CLEAN ALL DATA
define('IS_ADD',0);//SET DATA
$mobj = MQ::setupMq('127.0.0.1','11211');
if (FLUSH_MQ) {
	MQ::mflush($mobj);
} else {
	if (IS_ADD) {
		MQ::add('user_sync', '1test');
		MQ::add('user_sync', '2test');
		MQ::add('user_sync', '3test');
		MQ::add('user_sync', '4test');
		MQ::add('user_sync', '5test');
		MQ::add('user_sync', '6test');
	} else {
		MQ::get('user_sync', 10);
	}
	
}
MQ::Debug();
?>


<?php



exit;
echo json_encode(array(array(array('a' => 'aaa', 'b' => 'bbb'), array('c' => 'ccc', 'd' => 'ddd')), array('e' => 'eee')));
// [{"a":"aaa", "b":"bbb"}, {"c":"ccc", "d":"ddd"}]
die;
$arr = array('test1', 'test2', 'test3');
		array_splice($arr, 1, -1);
		print_r($arr);die;
$arr = array(array());
echo '<pre>';
print_r($arr);die;
$unsorted = array(43,21,2,1,9,24,2,99,23,8,7,114,92,5);

function quick_sort($array)
{
	$length = count($array);
	
	if($length < 2) return $array;
	
	$pivotKey = intval($length / 2);
	$pivot = $array[$pivotKey];
	$left = array();
	$right = array();
	print_r($pivot);
	print_r($array);
	for($i = 0; $i < $length; $i++){
		if($i != $pivotKey){
			if($array[$i] < $pivot){
				$right[] = $array[$i]; 
				
			}else{
				
				$left[] = $array[$i];
			}
		}
		
	}
	print_r($left);
	print_r($right);
	
	
	return array_merge(quick_sort($left), array($pivot), quick_sort($right));
}

$sorted = quick_sort($unsorted);
print_r($sorted);die;
/*header('Cache-control:max-age=5');
function getLastNum($peopleCount, $outNum){
	$sortPeople = array();
	for($i = 1; $i <= $peopleCount; $i++){
		$sortPeople[] = $i;
	}
	$i = 1;
	while(count($sortPeople) > 1){
		$head = array_shift($sortPeople);
		
		if($i % $outNum != 0){
			array_push($sortPeople, $head);
			
		}	
		$i++;
	}
	return current($sortPeople);
	
}

var_dump(getLastNum(6, 2));die;*/
$ar = array(
	array("10", 11, 100, 100, "a"),
	array(1, 2, "2", 3, 1)
);
array_multisort($ar[0], SORT_NUMERIC, SORT_ASC,
                $ar[1], SORT_NUMERIC, SORT_ASC);
var_dump($ar);

die;
set_exception_handler('myexhandler');
function myexhandler($exception){
	$tpl = <<<HTML
	<h2>exception
HTML;
	$tpl .= $exception->getMessage();
	$tpl .= <<<HTML
	</h2>
HTML;
	echo $tpl;
	 
	
}
class test{
	function b($arg1){
			throw new Exception('11111');
			var_dump($arg1);die;
		
	}
	
}
function a(){
	$args = func_get_args();
	$test = new test();
	call_user_func_array(array($test, 'b'), $args);
}


a(1,2,3);
?>