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
	const T_NUMERIC_INT = 301;
	const T_STRING_SQL = 401;
	const T_STRING_HTML = 402;
	const T_STRING_JSON = 403;

	const T_ARRAY_UPLOADED_FILE = 201;

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

	private function __construct(){
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
			$type = $this->vars[$name]['type'];
			$fallback = $this->vars[$name]['fallback'];
			$allowNull = $this->vars[$name]['allowNull'];;
				$this->saveVar($name, $type, $data, $fallback, $allowNull);
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

	// call fallback function for given variable
	function fallback($name){
		// does the varaible exist?
		if(array_key_exists($name,$this->vars)){
			$type = $this->vars[$name]['type'];
			$fallback = $this->vars[$name]['fallback'];
			$allowNull = $this->vars[$name]['allowNull'];;
			if(is_callable($fallback)){
				$this->saveVar($name, $type, $fallback(), $fallback, $allowNull);
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
	public function saveGlobal($name, $type, $lookup, callable $fallback = NULL, $allowNull = FALSE){
		if(is_array(self::$SUPERGLOBALS[$lookup])){ // does the lookup destination exist?
			if(array_key_exists($name,self::$SUPERGLOBALS[$lookup])){ // does such a variable exist?
				$this->saveVar($name, $type, self::$SUPERGLOBALS[$lookup][$name], $fallback, $allowNull); // save the variable
			}else if(is_callable($fallback)){
				$this->saveVar($name, $type, $fallback(), $fallback, $allowNull);
			}else{
				throw new InvalidArgumentException('name');
			}
		}else{
			throw new InvalidArgumentException('lookup');
		}
	}

	// save a completely unknown variable
	public function saveVar($name, $type, $data, callable $fallback = NULL, $allowNull = FALSE){
		if(!($allowNull && is_null($data))){
			try{
				$data = $this->makeTypeSave($type, $data);
			}catch (InvalidArgumentException $e){
				// try to fallback
				if(!is_callable($fallback)){
					throw $e;
				}
				$data = $this->makeTypeSave($type, $fallback());
			}
		}
		// save the variable
		$this->vars[$name]['data'] = $data;
		$this->vars[$name]['type'] = $type;
		$this->vars[$name]['fallback'] = $fallback;
		$this->vars[$name]['allowNull'] = $allowNull;

	}

	private function makeTypeSave($type, $data){
		switch ($type){ // make save variable now
			// basic
			case self::T_NULL: $data = $this->saveNull($data); break;
			case self::T_SCALAR: $data = $this->saveScalar($data); break;
			case self::T_ARRAY: $data = $this->saveArray($data); break;
			case self::T_NUMERIC: $data = $this->saveNumeric($data); break;
			case self::T_STRING: $data = $this->saveString($data); break;
			case self::T_BOOL: $data = $this->saveBool($data); break;
			case self::T_INT: $data = $this->saveInteger($data); break;
			case self::T_LONG: $data = $this->saveLong($data); break;
			case self::T_DOUBLE: $data = $this->saveDouble($data); break;
			case self::T_FLOAT: $data = $this->saveFloat($data); break;
			case self::T_RESOURCE: $data = $this->saveResource($data); break;
			case self::T_CALLABLE: $data = $this->saveCallable($data); break;
			case self::T_OBJECT: $data = $this->saveObject($data); break;
			// extended
			case self::T_NUMERIC_INT: $data = $this->saveInteger(intval($this->saveNumeric($data))); break;
			case self::T_STRING_SQL: $data = $this->saveSql($this->saveString($data)); break;
			case self::T_STRING_HTML: $data = $this->saveHtml($this->saveString($data)); break;
			case self::T_STRING_JSON: $data = $this->saveJson($this->saveString($data));  break;
			case self::T_ARRAY_UPLOADED_FILE: $data = $this->saveUploadedFile($this->saveArray($data)); break;
			default: 
				throw new InvalidArgumentException('type');
			break;
		}
		return $data;
	}

	//===================
	/*MAKE-SAVE-Methods*/
	private function saveNull($data){
		if( !is_null($data) ){
			throw new InvalidArgumentException('data');
		}
		return $data;
	}

	private function saveScalar($data){
		if( !is_scalar($data) ){
			throw new InvalidArgumentException('data');
		}
		return $data;
	}

	private function saveArray($data){
		if( !is_array($data) ){
			throw new InvalidArgumentException('data');
		}
		return $data;
	}

	private function saveNumeric($data){
		if( !is_numeric($data) ){
			throw new InvalidArgumentException('data');
		}
		return $data;
	}

	private function saveString($data){
		if( !is_string($data) ){
			throw new InvalidArgumentException('data');
		}
		return $data;
	}

	private function saveBool($data){
		if( !is_bool($data) ){
			throw new InvalidArgumentException('data');
		}
		return $data;
	}

	private function saveInteger($data){
		if( !is_integer($data) ){
			throw new InvalidArgumentException('data');
		}
		return $data;
	}

	private function saveLong($data){
		if( !is_long($data) ){
			throw new InvalidArgumentException('data');
		}
		return $data;
	}

	private function saveDouble($data){
		if( !is_double($data) ){
			throw new InvalidArgumentException('data');
		}
		return $data;
	}

	private function saveFloat($data){
		if( !is_float($data) ){
			throw new InvalidArgumentException('data');
		}
		return $data;
	}

	private function saveResource($data){
		if( !is_resource($data) ){
			throw new InvalidArgumentException('data');
		}
		return $data;
	}

	private function saveCallable($data){
		if(!is_callable($data) ){
			throw new InvalidArgumentException('data');
		}
		return $data;
	}

	private function saveObject($data){
		if( !is_object($data) ){
			throw new InvalidArgumentException('data');
		}
		return $data;
	}

	private function saveSql($data){
		return addslashes($data);
	}

	private function saveHtml($data){
		return htmlentities($data,ENT_QUOTES);
	}

	private function saveJson($data){
		$returnJson = json_decode($data);
		if( json_last_error() != JSON_ERROR_NONE){
			throw new InvalidArgumentException('data');
		}
		return $returnJson; 
	}

	private function saveUploadedFile($data){
		if( !array_key_exists('tmp_name',$data) 
			|| !is_uploaded_file($data['tmp_name'])
			|| (
				array_key_exists('error', $data)
				&& $data['error'] != UPLOAD_ERR_OK 
			)){
				throw new InvalidArgumentException('data');
		}
		return $data;
	}
}

?>
