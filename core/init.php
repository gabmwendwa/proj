<?php

session_start();

$GLOBALS['config']= array(
	'mysql' => array(
		'host' => '127.0.0.1',
		'username' => 'uvm',
		'password' => 'Password@123',
		'db' => 'project'
	),
	'session' => array(
		'token_name' => 'token'
	)
);

spl_autoload_register(function($class) {
	require_once ('/var/www/html/project/classes/' . $class . '.php');
});

require_once ('/var/www/html/project/functions/sanitize.php');

?>