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
	private $inc;		// the include object
	private $doctype;	// location of the doctype.
	private $template;	// the template
	private $vars;		// known variables

	function __construct($inc,$doctype,$vars = array(),$metadata = array()){
		$this->inc = $inc;
		$this->doctype = $doctype;
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
		$this->vars = array_merge($this->vars,$vars);
		$this->vars['metadata'] = array_merge($this->vars['metadata'],$metadata);

		// attach this template to the include system..
		$this->inc->settemplate($this);
	}

	private function stringtohtml($string){ // convert a string to html format
		return htmlentities($string,ENT_QUOTES);
	}

	// render the template
	function render(){
		//first include doctype
		$this->inc->doinclude($this->doctype);
		// now include the template
		$this->inc->doinclude($this->template);
	}
}
?>
