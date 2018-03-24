<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);

if(file_exists('_nu')){
	define('server','localhost');
	define('user','root');
	define('pass','');
	define('db','cmpn');
}
else{
	define('server','localhost');
	define('user','');
	define('pass','');
	define('db','');
}
	$db = mysqli_connect(server,user,pass,db);
?>