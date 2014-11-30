<?php
/*	savevars.php
*	Mischa Lehmann
*	ducksource@duckpond.ch
*	Version:1.0
*
*	Validate variables / input
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

class DisabledGlobal implements arrayaccess {


	public function disabled($offset = NULL, $value = NULL){
		throw new RuntimeException("Invalid access to disabled globals; \$_[$offset] = $value");
	}

	public function offsetExists ( $offset ){
		self::disabled($offset);
	}

	public function offsetGet ( $offset ){
		self::disabled($offset);
	}

	public function offsetSet ( $offset , $value ){
		self::disabled($offset, $value);
	}

	public function offsetUnset ( $offset ){
		self::disabled($offset);
	}
}

class SaveVars{

	/*Variable Types*/
	/*BASE_TYPES*/
	const T_NULL = 0;
	const T_SCALAR = 100;
	const T_ARRAY = 200;
	const T_NUMERIC = 300;
	const T_STRING = 400;
	const T_BOOL = 500;
	const T_INT = 600;
	const T_LONG = 700;
	const T_DOUBLE = 800;
	const T_FLOAT = 900;
	const T_RESOURCE = 1000;
	const T_CALLABLE = 1100;
	const T_OBJECT = 1200;

	/*EXTENDED_TYPES*/
	const T_STRING_SQL = 401;
	const T_STRING_HTML = 402;

	/*Variables*/ 
	private $vars;	// the variables struct:

	/*GLOBALS*/
	const G_SERVER = 0; 
	const G_GET = 1;
	const G_POST = 2;
	const G_FILES = 3;
	const G_REQUEST = 4;
	const G_SESSION = 5;
	const G_ENV = 6;
	const G_COOKIE = 7;

	/* Superglobal variables like 'GET/POST/ENV/SERVER */
	private $globals;

	function __construct(){
		$this->vars = array();
		/*Make superglobals only accessible through this class*/
		self::disable_superglobals();
	}

	function __destruct(){
		/* Save used vars in session */
		foreach($this->vars as $key => $val){
			$this->globals[self::G_SESSION][$key] = $val;
		}
	}

	/* Call cb with enabled superglobals */
	public function call_enabled_superglobals(callable $cb){
		self::enable_superglobals();
		$cb();
		self::disable_superglobals();
	}

	private function disable_superglobals(){
		if(isset($_SERVER)){
			$this->globals[self::G_SERVER] = $_SERVER;
			unset($_SERVER);
			$_SERVER = new DisabledGlobal();
		}

		if(isset($_GET)){
			$this->globals[self::G_GET] = $_GET;
			unset($_GET);
			$_GET = new DisabledGlobal();
		}

		if(isset($_POST)){
			$this->globals[self::G_POST] = $_POST; 
			unset($_POST);
			$_POST = new DisabledGlobal();
		}

		if(isset($_FILES)){
			$this->globals[self::G_FILES] = $_FILES;
			unset($_FILES);
			$_FILES = new DisabledGlobal();
		}

		if(isset($_REQUEST)){
			$this->globals[self::G_REQUEST] = $_REQUEST;
			unset($_REQUEST);
			$_REQUEST = new DisabledGlobal();
		}

		if(isset($_SESSION)){
			$this->globals[self::G_SESSION] = $_SESSION;
			unset($_SESSION);
			$_SESSION = new DisabledGlobal();
		}

		if(isset($_ENV)){
			$this->globals[self::G_ENV] = $_ENV;
			unset($_ENV);
			$_ENV = new DisabledGlobal();
		}

		if(isset($_COOKIE)){
			$this->globals[self::G_COOKIE] = $_COOKIE;
			unset($_COOKIE);
			$_COOKIE = new DisabledGlobal();
		}

	}

	private function enable_superglobals(){
		if(isset($this->globals[self::G_SERVER])){
			$_SERVER = $this->globals[self::G_SERVER];
		}

		if(isset($this->globals[self::G_GET])){
			$_GET = $this->globals[self::G_GET];
		}

		if(isset($this->globals[self::G_POST])){
			$_POST = $this->globals[self::G_POST];
		}

		if(isset($this->globals[self::G_FILES])){
			$_FILES = $this->globals[self::G_FILES];
		}

		if(isset($this->globals[self::G_REQUEST])){
			$_REQUEST = $this->globals[self::G_REQUEST];
		}

		if(isset($this->globals[self::G_SESSION])){
			$_SESSION = $this->globals[self::G_SESSION];
		}

		if(isset($this->globals[self::G_ENV])){
			$_ENV = $this->globals[self::G_ENV];
		}

		if(isset($this->globals[self::G_COOKIE])){
			$_COOKIE = $this->globals[self::G_COOKIE];
		}

	}


	//========================
	/*Set/Get save variables*/

	// set a new save variable (type must be known..)
	function __set($name,$data){
		// does the varaible exist?
		if(array_key_exists($name,$this->vars)){
			$ret = self::save_var($name,$data,$this->vars[$name]['type']);
		}
	}

	function __get($name){ // return a given variable for display
		$ret = NULL;
		// does the varaible exist?
		if(array_key_exists($name,$this->vars)){
			$ret = $this->vars[$name]['data'];
		}
		return $ret;
	}

	//=================
	/*Save variables*/

	// save global variable from type $type
	// look in the global variables defined by lookup 
	// if such a variable couldnt be found use the fallback function given
	function save_global($name, $type, $lookup, $fallback = NULL){
		$ret = false;
		if(is_array($this->globals[$lookup])){ // does the lookup destination exist?
			if(array_key_exists($name,$this->globals[$lookup])){ // does such a variable exist?
				$ret = self::save_var($name,$this->globals[$lookup][$name],$type); // save the variable
			}else if(is_callable($fallback)){
				$ret = self::save_var($name,$fallback(),$type);
			}
		}
		return $ret;
	}

	// save a completely unknown variable
	function save_var($name, $data, $type){
		$ret = false;
		$type_valid = true;

		switch ($type){ // make save variable now
			// basic
			case self::T_NULL: $data = self::save_null((unset)$data); break;
			case self::T_SCALAR: $data = self::save_scalar($data); break;
			case self::T_ARRAY: $data = self::save_array((array)$data); break;
			case self::T_NUMERIC: $data = self::save_numeric($data); break;
			case self::T_STRING: $data = self::save_string((string)$data); break;
			case self::T_BOOL: $data = self::save_bool((bool)$data); break;
			case self::T_INT: $data = self::save_integer((int)$data); break;
			case self::T_LONG: $data = self::save_long((int)$data); break;
			case self::T_DOUBLE: $data = self::save_double((float)$data); break;
			case self::T_FLOAT: $data = self::save_float((float)$data); break;
			case self::T_RESOURCE: $data = self::save_resource($data); break;
			case self::T_CALLABLE: $data = self::save_callable($data); break;
			case self::T_OBJECT: $data = self::save_object((object)$data); break;
			// extended
			case self::T_STRING_SQL: $data = self::save_sql(self::save_string($data)); break;
			case self::T_STRING_HTML: $data = self::save_html(self::save_string($data)); break;

			// not valid type
			default: 
				$type_valid = false;
			break;
		}

		// save the variable
		if($type_valid == true){
			$this->vars[$name]['data'] = $data;
			$this->vars[$name]['type'] = $type;
			$ret = true;
		}

		return $ret;
	}	

	//===================
	/*MAKE-SAVE-Methods*/
	private function save_null($var){
		if( $var == null
		|| !is_null($var)){
			return null; // not a valid variable of this type
		}
		return $var;
	}

	private function save_scalar($var){
		if( $var == null
		|| !is_scalar($var)){
			return null; // not a valid variable of this type
		}
		return $var;
	}

	private function save_array($var){
		if( $var == null
		|| !is_array($var)){
			return null; // not a valid variable of this type
		}
		return $var;
	}

	private function save_numeric($var){
		if( $var == null
		|| !is_numeric($var)){
			return null; // not a valid variable of this type
		}
		return $var;
	}

	private function save_string($var){
		if( $var == null
		|| !is_string($var)){
			return null; // not a valid variable of this type
		}
		return $var;
	}

	private function save_bool($var){
		if( $var == null
		|| !is_bool($var)){
			return null; // not a valid variable of this type
		}
		return $var;
	}

	private function save_integer($var){
		if( $var == null
		|| !is_integer($var)){
			return null; // not a valid variable of this type
		}
		return $var;
	}

	private function save_long($var){
		if( $var == null
		|| !is_long($var)){
			return null; // not a valid variable of this type
		}
		return $var;
	}

	private function save_double($var){
		if( $var == null
		|| !is_double($var)){
			return null; // not a valid variable of this type
		}
		return $var;
	}

	private function save_float($var){
		if( $var == null
		|| !is_float($var)){
			return null; // not a valid variable of this type
		}
		return $var;
	}

	private function save_resource($var){
		if( $var == null
		|| !is_resource($var)){
			return null; // not a valid variable of this type
		}
		return $var;
	}

	private function save_callable($var){
		if( $var == null
		|| !is_callable($var)){
			return null; // not a valid variable of this type
		}
		return $var;
	}

	private function save_object($var){
		if( $var == null
		|| !is_object($var)){
			return null; // not a valid variable of this type
		}
		return $var;
	}

	private function save_sql($var){
		if( $var == null ){
			return null;
		}
		return addslashes($var);
	}

	private function save_html($var){
		if( $var == null){
			return null;
		}
		return htmlentities($var,ENT_QUOTES);
	}

}

?>
