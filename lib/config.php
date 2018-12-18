<?php

session_start();
date_default_timezone_set('America/New_York');
//header('Content-Type: text/html; charset=utf-8');

//$whoops = new \Whoops\Run;
//$whoops->pushHandler(new \Whoops\Handler\PrettyPageHandler);
//$whoops->register();
//error_reporting(E_ALL);
//ini_set('display_errors', 1);

//echo 'ip' .

define('DB_TYPE', 'mysql');
define('LOCALHOST', 'localhost');
define('DB_NAME', 'crudgen');
define('DB_USERNAME', 'homestead');
define('DB_PASSWORD', 'secret');


?>