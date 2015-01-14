<?php
header('Content-type:text/html;charset=utf-8');
define('ROOT_PATH', __DIR__ . '/');
define('LIB_PATH', __DIR__ . '/lib/');
include LIB_PATH . 'base.php';
include LIB_PATH . 'request.php';
include LIB_PATH . 'route.php';
include LIB_PATH . 'config.php';
include LIB_PATH . 'db/factory.php';
set_exception_handler('exceptionHandler');
global $db;
Config::init();
$db = dbFactory::init('mysql');
$db->connect();

$route = new Route(new Request());

