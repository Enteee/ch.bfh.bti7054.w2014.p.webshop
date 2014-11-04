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
	private $template = null;
	private $passvars = array();

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

		// have a look in the template system if there is one..
		if(isset($this->template)){
			$var = $this->template->__get($name);
			if(isset($var)){
				return $var;
			}
		}

		if(array_key_exists($name,$GLOBALS)){
			return $GLOBALS[$name];
		}
	}

	// autoloader
	static function autoload($class_name) {
		global $inc;
		$inc->dorequire($class_name . '.php');
	}

	// set variables of a page
	function set_vars($page,$vars = array()){
		if ( $page !== "" 
		&& is_array($vars)){
			if(array_key_exists($page,$this->passvars)){
				array_merge($this->passvars[$page],$vars);
			}else{
				// key doesnt exist add array
				$this->passvars[$page] = $vars; 
			}
		}
	}

	private function get_vars($page){
		if(array_key_exists($page,$this->passvars)){
			return $this->passvars[$page];
		}

		return array();
	}

	function settemplate($template){
		$this->template = $template;
	}

	function doinclude($page){ // include a page
		$this->num_includes++; // inc counter

		// load passed variables
		foreach (self::get_vars($page) as $key => $val){
			$$key = $val;
		}

		return include_once($page);
	}

	function dorequire($page){ // require a page
		$this->num_includes++; // inc counter

		// load passed variables
		foreach (self::get_vars($page) as $key => $val){
			$$key = $val;
		}

		return require_once($page);
	}

	function getpath($page){ // get path to a file
		foreach($this->paths as $path){
			// Add a trailing / if necessary

			if(substr($path,-1,1) != '/'){
				$path = $path.'/';
			}
			$fpath = $path.$page;
			if(file_exists($fpath)) // does the file exist?
				return $fpath;
		}

		return false;
	}
}

?>
