<?php
$file = fopen('test.txt', 'a');
for($i = 0; $i < 1000000000; $i++){
	fwrite($file, $i . "\r\n");
}
