<?php

/*
 * Class that handles the MVC stuff.
 */
class Mvc {

	const CONTROLLER_SUFFIX = 'Controller';

	public static $lang;

	protected $segments;
		
	protected $controllerName;
	protected $controllerNameDefault;
	protected $controllerNameError;
	protected $controller;
	
	protected $methodName;
	protected $methodNameFallback = 'index';

	public function __construct() {
		self::$lang = new Language();
		$this->segments  = array();
		$this->controllerNameDefault = 'StartController';
		$this->controllerNameError = 'ErrorController';
	}
	
	public function init() {
		$this->parseUri($_SERVER['REQUEST_URI']);
		
		$this->setLanguageByClient();
		
		$this->setLanguageByUri();
		$this->setControllerByUri();
		$this->setMethodByUri();
		
		
		self::$lang->init();
		
		$this->initController();
	}

	private function redirect() {
		header('Location: ' . '/' . self::$lang->getLanguage() . $_SERVER['REQUEST_URI']);
		exit;
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
		$clientLanguage = $_SERVER['HTTP_ACCEPT_LANGUAGE'];
		self::$lang->parseClientLanguage($clientLanguage);
	}	
	
	private function setLanguageByUri() {
		// language over uri?
		if (count($this->segments) > 0) {
			$language = strtolower($this->segments[0]);
			if (Language::isLanguageValid($language)) {
				// remove segment
				array_shift($this->segments);
				// set language				
				self::$lang->setLocale($language, NULL);
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
	
	private function setMethodByUri() {
		// method over uri?
		if (count($this->segments) > 0) {
			$this->methodName = strtolower(array_shift($this->segments));
		}
	}
	
	private function controllerExists($name) {
		return file_exists('../controller/' . $name . '.php');
	}
	
	private function initController() {
		// create controller
		if (!$this->controllerExists($this->controllerName)) {		
			// use fallback
			$this->controllerName = $this->controllerNameError;
			$this->methodName = 'error404';
		}
		$this->controller = new $this->controllerName();

		// call method
		if (method_exists($this->controller, $this->methodName)) {
			$method = $this->methodName;
			$this->controller->$method();
		} else {
			$this->methodName = $this->methodNameFallback;
			if (!method_exists($this->controller, $this->methodName)) {
				throw new Exception('Controller has no index method.');
			}
			// call fallback method
			$method = $this->methodName;
			$this->controller->$method();
		}
	}	
}

?>
