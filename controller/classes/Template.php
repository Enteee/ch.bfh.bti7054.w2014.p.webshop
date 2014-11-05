<?php
/*	template.php
*	Mischa Lehmann
*	ducksource@duckpond.ch
*	Version:1.0
*
*	Template class for proper html / php separation
*	Require:
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

class Template{
	private $doctype;
	private $include_path;
	private $base_path;
	private $paths;
	private $template;
	private $vars;

	function __construct($doctype,$include_path,$base_path,$paths = array(),$vars = array(),$metadata = array()){
		$this->doctype = $doctype;
		$this->include_path = $include_path;
		$this->base_path = $base_path;
		$this->paths = $paths;
		$this->vars = $vars;
		$this->vars['metadata'] = $metadata;
	}

	function __get($name){ // return a given variable for display
		$ret = self::var_get($name); // get variable
		// if this is a string convert to string to html format
		if(is_string($ret)){ 
			$ret = $this->stringtohtml($ret);
		}
		return $ret;
	}

	function var_get($name){ // get a variable
		$ret = null;
		if(array_key_exists($name,$this->vars)){
			$ret = $this->vars[$name];
		}
		return $ret;
	}

	// add variables to the current template
	function vars_add($vars = array(),$metadata = array()){
		$this->vars = array_merge($this->vars,$vars);
		$this->vars['metadata'] = array_merge($this->vars['metadata'],$metadata);
	}

	// initialize the template
	function init($template,$vars = array(),$metadata = array()){
		$this->template = $template;
		$this->vars_add($vars,$metadata);
	}

	private function stringtohtml($string){ // convert a string to html format
		return htmlentities($string,ENT_QUOTES);
	}

	function doinclude($page){ // include a page
		$this->num_includes++; // inc counter
		return include_once($page);
	}

	function getpath($page){ // get path to a file
		$return_path = null;
		foreach($this->paths as $path){
			$fpath = $this->base_path.'/'.$path.'/'.$page;
			if(file_exists($fpath)){
				$return_path = $path.'/'.$page;
				break;
			}
		}
		return $return_path;
	}

	// render the template
	function render(){
		//first include doctype
		include($this->doctype);
		// now include the template
		include($this->template);
	}
}
?>
