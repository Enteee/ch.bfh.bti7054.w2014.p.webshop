<?php

/*
 * Class that handles the MVC stuff.
 */
class Mvc {

	const CONTROLLER_SUFFIX = 'Controller';

	/* Singleton */
	private static $INSTANCE;

	public static function getInstance() {
		if(!isset(self::$INSTANCE)){
			self::$INSTANCE = new self;
		}
		return self::$INSTANCE;
	}
	

	protected $lang;

	protected $segments;
		
	protected $controllerName;
	protected $controllerNameDefault;
	protected $controllerNameError;
	protected $controller;
	
	protected $methodName;
	protected $methodNameFallback = 'index';

	private function __construct() {
		$this->lang = Language::getInstance();
		$this->segments  = array();
		$this->controllerNameDefault = 'ProductsController';
		$this->controllerNameError = 'ErrorController';
	}

	public function init() {
		if (!isset($_SERVER['REQUEST_URI'])) {
			throw Exception('request uri not found.');
		}
		$this->parseUri($_SERVER['REQUEST_URI']);
		
		$this->setLanguageByClient();
		$this->setLanguageByUri();
		$this->setControllerByUri();
		$this->setMethodByUri();
		
		$this->lang->init();
		
		$this->initController();
	}

	private function redirect() {
		header('Location: ' . '/' . $this->lang->getLanguage() . $_SERVER['REQUEST_URI'], true, 307);
		exit();
	}
	
	private function parseUri($uri) {
		// remove filename if not removed with url rewrite
		$uri = preg_replace('~(index\.php)~i', '', $uri);

		// parse segments
		$matches = array();
		preg_match_all('~(?<=/)([^/?&=])+((?=/|\?)|$)~', $uri, $matches);
		if (isset($matches) && count($matches) > 0 && count($matches[0]) > 0) {
			// segments found
			$this->segments = $matches[0];
		}
	}
		
	public function setLanguageByClient() {
		// parse locale
		$clientLanguage = '';
		if (isset($_SERVER['HTTP_ACCEPT_LANGUAGE'])) {
			$clientLanguage = $_SERVER['HTTP_ACCEPT_LANGUAGE'];
		}
		$this->lang->parseClientLanguage($clientLanguage);
	}
	
	private function setLanguageByUri() {
		// language over uri?
		if (count($this->segments) > 0) {
			$language = strtolower($this->segments[0]);
			if (Language::isLanguageValid($language)) {
				// remove segment
				array_shift($this->segments);
				// set language
				$this->lang->setLocale($language, NULL);
				return;
			}
		}
		$this->redirect();
	}
	
	private function setControllerByUri() {
		// controller over uri?
		if (count($this->segments) > 0) {
			$this->controllerName = ucwords(array_shift($this->segments)) . self::CONTROLLER_SUFFIX;
		} else {
			// use default
			$this->controllerName = $this->controllerNameDefault;
		}
	}
	
	public function getControllerName(){
		return $this->controllerName;
	}
	
	private function setMethodByUri() {
		// method over uri?
		if (count($this->segments) > 0) {
			$this->methodName = strtolower(array_shift($this->segments));
		}
	}

	public function getMethod(){
		return $this->methodName;
	}
	
	private function controllerExists($name) {
		return file_exists('../controller/' . $name . '.php');
	}
	
	private function initController() {
		try {
			// create controller
			if (!$this->controllerExists($this->controllerName)) {
				throw new NotFoundException();
			}
			$this->controller = new $this->controllerName();

			// call method
			if (method_exists($this->controller, $this->methodName)) {
				$this->callMethod();
			} else {
				$this->methodName = $this->methodNameFallback;
				if (!method_exists($this->controller, $this->methodName)) {
					throw new Exception('Controller has no index method.');
				}
				// call fallback method
				$this->callMethod();
			}
		} catch (SecurityException $ex) {
			$this->forbidden($ex);
		} catch (NotFoundException $ex) {
			$this->notFound($ex);
		} catch (Exception $ex) {
			$this->error($ex);
		}
	}
	
	private function callMethod() {
		$rflClass = new ReflectionClass($this->controller);
		$rflMethod = $rflClass->getMethod($this->methodName);
		$rflParameters = $rflMethod->getParameters();
		$args = array();
		if (count($rflParameters) > 0) {		
			for ($i = 0; $i < count($rflParameters); $i++) {
				if (count($this->segments) > $i) {
					$args[] = $this->segments[$i];
				} else {
					$args[] = NULL;
				}
			}
		}
		call_user_func_array(array($this->controller, $this->methodName), $args);
	}

	private function forbidden($exception) {
		$this->controllerName = $this->controllerNameError;
		$this->controller = new $this->controllerName();
		$this->controller->error403($exception);
	}
	
	private function notFound($exception) {
		$this->controllerName = $this->controllerNameError;
		$this->controller = new $this->controllerName();
		$this->controller->error404();
	}
	
	private function error($exception) {
		$this->controllerName = $this->controllerNameError;
		$this->controller = new $this->controllerName();
		$this->controller->error500($exception);
	}	
}

?>
