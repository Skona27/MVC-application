<?php

session_start();

$GLOBALS['config'] = array(
	'version' => '1.0.0',
	'mysql' => array(
		'host' 		=>	'127.0.0.1',
		'username' 	=>	'root',
		'password'	=>	'',
		'db' 		=>	'test'
	),
	'path' => array(
		'public' 	=>	'http://192.168.1.14/MVC-application/public', //adres strony www.example.com
		'uploads' =>	'http://192.168.1.14/MVC-application/public/uploads/'
	),
	'dir' => array(
		'public' => $_SERVER['DOCUMENT_ROOT'] . '/mvc/public/',
		'uploads' => $_SERVER['DOCUMENT_ROOT'] . '/mvc/public/uploads/'
	),
	'session' => array(
		'session_name' => 'user',
		'token_name' => 'token'
	),
	'stats' => array(
		'cookie_expiry' => 14 * 86400
	),
	'remember' => array(
		'cookie_name' => 'hash',
		'cookie_expiry' => 7 * 86400
	),
	'file' => array(
		'max_size' => 5,
		'image_ext' => array('jpg', 'jpeg', 'png')
	)
);

spl_autoload_register(function($class) {
	require_once 'classess/' . $class . '.php';
});

if(Cookie::exists(Config::get('remember/cookie_name')) && !Session::exists(Config::get('session/session_name'))) {
	$hash = Cookie::get(Config::get('remember/cookie_name'));
	$hashCheck = Database::getInstance()->search('users_session', array('hash', '=', $hash));

	if($hashCheck->count()) {
		$user = new User($hashCheck->first()->user_id);
		$user->login();
	}
}

//zapisać w configu wszystkie nazwy tabel, folderow i sciezki