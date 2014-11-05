<?php
/*	include_classes_inc.php
*	Mischa Lehmann
*	ducksource@duckpond.ch
*	Version:1.0 
*
*	Loads and keeps track of required classes
*	Require:
*
*
*	Licence:
*	You're allowed to edit and publish my source in all of your free and open-source projects.
*	Please send me an e-mail if you'll implement this source in one of your commercial or proprietary projects.
*	Leave this Header untouched!
*
*	Warranty:
*		Warranty void if signet is broken
*	================== / /===================
*	[    Waranty      / /    Signet         ]
*	=================/ /=====================
*	!!Wo0t!!
*/

class Include_handler{
	private $paths;
	private $num_includes = 0;

	function __construct($paths = array()){
		define('INCLUDED','1'); // define constant so that files can check for that constant
		$this->paths = $paths;
		// and add all those path to the include path variable
		$includepaths='';
		foreach($paths as $path)
			$includepaths.=PATH_SEPARATOR.$path;
		set_include_path(get_include_path().$includepaths); // and set it
	}

	function __get($name){
		if(array_key_exists($name,$GLOBALS)){
			return $GLOBALS[$name];
		}
	}

	// autoloader
	static function autoload($class_name) {
		global $inc;
		$inc->dorequire($class_name . '.php');
	}

	function doinclude($page){ // include a page
		$this->num_includes++; // inc counter
		return include_once($page);
	}

	function dorequire($page){ // require a page
		$this->num_includes++; // inc counter
		return require_once($page);
	}

	function getpath($page){ // get path to a file
		$return_path = null;
		foreach($this->paths as $path){
			$fpath = $path.'/'.$page;
			if(file_exists($fpath)) // does the file exist?
				$return_path = $fpath;
				break;
		}
		return $return_path;
	}
}

/* Register autloader */
spl_autoload_register(array('Include_handler', 'autoload'))
?>
