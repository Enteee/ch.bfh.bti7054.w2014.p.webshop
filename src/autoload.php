<?php

// define constant so that files can check for that constant
define('CODESHOP_AUTOLOAD', '1');

// autoloader
function codeshop_autoload($class_name) {
	$locations = array(
		'../src/',
		'../src/classes/',
		'../controller/'		
	);
	foreach ($locations as $location) {
		$path = $location . $class_name . '.php';
		if (file_exists($path)) {
			require_once $path;
			return;
		}
	}
	return false;
}

/* Register autloader */
spl_autoload_register('codeshop_autoload');

?>
