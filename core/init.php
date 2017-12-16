<?php
session_start();

$GLOBALS['config'] = array(
	'mysql' => array(
		'host' => 'localhost',
		'username' => 'root',
		'password' => '',
		'db' => 'movie_store'
		),
	'remember' => array(
		'cookie_name' =>'hash',
		'cookie_expiry' => 604800
		),
	'session' =>array(
		'session_name' => 'user',
		'token_name' => 'token'
		)

	);

spl_autoload_register(function($class){
	require_once 'classes/' . $class . '.php';
});

require_once'functions/sanitize.php';


if(cookie::exists(config::get('remember/cookie_name')) && !session::exists(config::get('session/session_name'))){
	$hash = cookie::get(config::get('remember/cookie_name'));
	$hashCheck = DB::getInstance()->get('users_session', array('hash', '=', $hash));

	if($hashCheck->count()){
		$user= new user($hashCheck->first()->user_id);
		$user->login();
	}
}
