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
		throw new RuntimeException("Invalid access to disabled globals; \$_SUPERGLOBAL[$offset] = $value");
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
	private $vars = array();	// the variables struct:

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
	private static $SUPERGLOBALS_ENABLED = true;
	private static $SUPERGLOBALS;

	/* Singelton */
	private static $INSTANCE;

	/* Default fallback */
	private static $DEFAULT_FALLBACK;

	private function __construct(){
		self::$DEFAULT_FALLBACK = function(){};
		// Make superglobals only accessible through this class
		$this->disableSuperglobals();
	}

	public function __destruct(){
		// Enable superglobals again
		$this->enableSuperglobals();
		// Save used vars in session
		session_unset();
		foreach($this->vars as $key => $val){
			$_SESSION[$key] = $val['data'];
		}
	}

	public static function getInstance(){
		if(!isset(self::$INSTANCE)){
			self::$INSTANCE = new self;
		}
		return self::$INSTANCE;
	}

	/* Call cb with enabled superglobals */
	public function callEnabledSuperglobals(callable $cb){
		$this->enableSuperglobals();
		$cb();
		$this->disableSuperglobals();
	}

	private function disableSuperglobals(){
		if(self::$SUPERGLOBALS_ENABLED){
			if(isset($_SERVER)){
				self::$SUPERGLOBALS[self::G_SERVER] = $_SERVER;
				$_SERVER = new DisabledGlobal();
			}

			if(isset($_GET)){
				self::$SUPERGLOBALS[self::G_GET] = $_GET;
				$_GET = new DisabledGlobal();
			}

			if(isset($_POST)){
				self::$SUPERGLOBALS[self::G_POST] = $_POST; 
				$_POST = new DisabledGlobal();
			}

			if(isset($_FILES)){
				self::$SUPERGLOBALS[self::G_FILES] = $_FILES;
				$_FILES = new DisabledGlobal();
			}

			if(isset($_REQUEST)){
				self::$SUPERGLOBALS[self::G_REQUEST] = $_REQUEST;
				$_REQUEST = new DisabledGlobal();
			}

			if(isset($_SESSION)){
				self::$SUPERGLOBALS[self::G_SESSION] = $_SESSION;
				$_SESSION = new DisabledGlobal();
			}

			if(isset($_ENV)){
				self::$SUPERGLOBALS[self::G_ENV] = $_ENV;
				$_ENV = new DisabledGlobal();
			}

			if(isset($_COOKIE)){
				self::$SUPERGLOBALS[self::G_COOKIE] = $_COOKIE;
				$_COOKIE = new DisabledGlobal();
			}
			self::$SUPERGLOBALS_ENABLED = false;
		}
	}

	private function enableSuperglobals(){
		if(!self::$SUPERGLOBALS_ENABLED){
			if(isset(self::$SUPERGLOBALS[self::G_SERVER])){
				$_SERVER = self::$SUPERGLOBALS[self::G_SERVER];
			}

			if(isset(self::$SUPERGLOBALS[self::G_GET])){
				$_GET = self::$SUPERGLOBALS[self::G_GET];
			}

			if(isset(self::$SUPERGLOBALS[self::G_POST])){
				$_POST = self::$SUPERGLOBALS[self::G_POST];
			}

			if(isset(self::$SUPERGLOBALS[self::G_FILES])){
				$_FILES = self::$SUPERGLOBALS[self::G_FILES];
			}

			if(isset(self::$SUPERGLOBALS[self::G_REQUEST])){
				$_REQUEST = self::$SUPERGLOBALS[self::G_REQUEST];
			}

			if(isset(self::$SUPERGLOBALS[self::G_SESSION])){
				$_SESSION = self::$SUPERGLOBALS[self::G_SESSION];
			}

			if(isset(self::$SUPERGLOBALS[self::G_ENV])){
				$_ENV = self::$SUPERGLOBALS[self::G_ENV];
			}

			if(isset(self::$SUPERGLOBALS[self::G_COOKIE])){
				$_COOKIE = self::$SUPERGLOBALS[self::G_COOKIE];
			}	
			self::$SUPERGLOBALS_ENABLED = true;
		}
	}


	//========================
	/*Set/Get save variables*/

	// set a new save variable (type must be known..)
	function __set($name,$data){
		// does the varaible exist?
		if(array_key_exists($name,$this->vars)){
			$this->saveVar($name,$data,$this->vars[$name]['type']);
		}else{
			throw new InvalidArgumentException('name');
		}
	}

	function __get($name){ // return a given variable for display
		$ret = NULL;
		// does the varaible exist?
		if(array_key_exists($name,$this->vars)){
			$ret = $this->vars[$name]['data'];
		}else{
			throw new InvalidArgumentException('name');
		}
		return $ret;
	}

	function fallback($name){
		// does the varaible exist?
		if(array_key_exists($name,$this->vars)){
			$type = $this->vars[$name]['type'];
			$fallback = $this->vars[$name]['fallback'];
			if(is_callable($fallback)){
				$this->saveVar($name,$fallback(),$type,$fallback);
			}else{
				throw new InvalidArgumentException('fallback');
			}
		}else{
			throw new InvalidArgumentException('name');
		}
	}

	//=================
	/*Save variables*/

	// save global variable from type $type
	// look in the global variables defined by lookup 
	// if such a variable couldnt be found use the fallback function given
	function saveGlobal($name, $type, $lookup, callable $fallback = NULL){
		if(is_array(self::$SUPERGLOBALS[$lookup])){ // does the lookup destination exist?
			if(array_key_exists($name,self::$SUPERGLOBALS[$lookup])){ // does such a variable exist?
				$this->saveVar($name,self::$SUPERGLOBALS[$lookup][$name],$type,$fallback); // save the variable
			}else if(is_callable($fallback)){
				$this->saveVar($name,$fallback(),$type,$fallback);
			}else{
				throw new InvalidArgumentException('name');
			}
		}else{
			throw new InvalidArgumentException('lookup');
		}
	}

	// save a completely unknown variable
	function saveVar($name, $data, $type, callable $fallback = NULL){
		switch ($type){ // make save variable now
			// basic
			case self::T_NULL: $data = $this->saveNull((unset)$data); break;
			case self::T_SCALAR: $data = $this->saveScalar($data); break;
			case self::T_ARRAY: $data = $this->saveArray((array)$data); break;
			case self::T_NUMERIC: $data = $this->saveNumeric($data); break;
			case self::T_STRING: $data = $this->saveString((string)$data); break;
			case self::T_BOOL: $data = $this->saveBool((bool)$data); break;
			case self::T_INT: $data = $this->saveInteger((int)$data); break;
			case self::T_LONG: $data = $this->saveLong((int)$data); break;
			case self::T_DOUBLE: $data = $this->saveDouble((float)$data); break;
			case self::T_FLOAT: $data = $this->saveFloat((float)$data); break;
			case self::T_RESOURCE: $data = $this->saveResource($data); break;
			case self::T_CALLABLE: $data = $this->saveCallable($data); break;
			case self::T_OBJECT: $data = $this->saveObject((object)$data); break;
			// extended
			case self::T_STRING_SQL: $data = $this->saveSql($this->save_string($data)); break;
			case self::T_STRING_HTML: $data = $this->saveHtml($this->save_string($data)); break;

			// not valid type
			default: 
				throw new InvalidArgumentException('type');
			break;
		}

		// save the variable
		$this->vars[$name]['data'] = $data;
		$this->vars[$name]['type'] = $type;
		$this->vars[$name]['fallback'] = $fallback;

	}

	//===================
	/*MAKE-SAVE-Methods*/
	private function saveNull($data){
		if( !isset($data)
		|| !is_null($data)){
			throw new InvalidArgumentException('data');
		}
		return $data;
	}

	private function saveScalar($data){
		if( !isset($data)
		|| !is_scalar($data)){
			throw new InvalidArgumentException('data');
		}
		return $data;
	}

	private function saveArray($data){
		if( !isset($data)
		|| !is_array($data)){
			throw new InvalidArgumentException('data');
		}
		return $data;
	}

	private function saveNumeric($data){
		if( !isset($data)
		|| !is_numeric($data)){
			throw new InvalidArgumentException('data');
		}
		return $data;
	}

	private function saveString($data){
		if( !isset($data)
		|| !is_string($data)){
			throw new InvalidArgumentException('data');
		}
		return $data;
	}

	private function saveBool($data){
		if( !isset($data)
		|| !is_bool($data)){
			throw new InvalidArgumentException('data');
		}
		return $data;
	}

	private function saveInteger($data){
		if( !isset($data)
		|| !is_integer($data)){
			throw new InvalidArgumentException('data');
		}
		return $data;
	}

	private function saveLong($data){
		if( !isset($data)
		|| !is_long($data)){
			throw new InvalidArgumentException('data');
		}
		return $data;
	}

	private function saveDouble($data){
		if( !isset($data)
		|| !is_double($data)){
			throw new InvalidArgumentException('data');
		}
		return $data;
	}

	private function saveFloat($data){
		if( !isset($data)
		|| !is_float($data)){
			throw new InvalidArgumentException('data');
		}
		return $data;
	}

	private function saveResource($data){
		if( !isset($data)
		|| !is_resource($data)){
			throw new InvalidArgumentException('data');
		}
		return $data;
	}

	private function saveCallable($data){
		if( !isset($data)
		|| !is_callable($data)){
			throw new InvalidArgumentException('data');
		}
		return $data;
	}

	private function saveObject($data){
		if( !isset($data)
		|| !is_object($data)){
			throw new InvalidArgumentException('data');
		}
		return $data;
	}

	private function saveSql($data){
		if( !isset($data) ){
			throw new InvalidArgumentException('data');
		}
		return addslashes($data);
	}

	private function saveHtml($data){
		if( !isset($data)){
			throw new InvalidArgumentException('data');
		}
		return htmlentities($data,ENT_QUOTES);
	}

}

?>
