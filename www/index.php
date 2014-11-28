<?php

/* Include configuration file */
require_once '../conf/config.php';

/* Autoloader */
require_once '../src/autoload.php';

/* Set up composer autoload */
require_once($config['composer']['autoload.php']);

/* Session */
session_start();

/* Debug settings */
if ($config['debug']) {
	ini_set('implicit_flush',1);				// flush stdout after each "echo"
	ini_set('display_errors',1);				// show errors
	ini_set('display_startup_errors',1);	// show starup errors
	error_reporting(-1);							// be verbose as fuck: http://php.net/manual/de/errorfunc.constants.php
}

/* Set php defaults */
if(!date_default_timezone_set($config['timezone'])){
	die('Invalid timezone in config');
}

/* Set up Propel */
Propel::init($config['propel_conf']);
set_include_path($config['propel_model'] . PATH_SEPARATOR . get_include_path());

/* Set up google client */
//$gitkitClient = Gitkit_Client::createFromFile($config['gitkit']['server-config']);
//$gitkitUser = $gitkitClient->getUserInRequest();

/* Load needed php modules */
if (isset($config['modules'])){
	foreach ($config['modules'] as $module) {
		if (!extension_loaded($module)){
			if (function_exists('dl')){
				if (!dl($module)){
					print('[Error] : Module loading failed');
					exit;
				}
			} else {
				// this happens with PHP > 5.3
				print('[Error] : Can not load module (dl missing)');
				exit;
			}
		}
	}
}

/* Initialize MVC */
$mvc = new Mvc();
$mvc->init();

?>
