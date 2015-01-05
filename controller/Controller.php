<?php

/*
 * Abstract class for MVC controllers.
 */
abstract class Controller {

	protected $config;
	protected $lang;
	protected $template;
	protected $repo;
	protected $vars;
	protected $session;
	private $gitkit;

	public function __construct() {
		global $config;
		
		// init ressource objects
		$this->config = $config; 
		$this->lang = Language::getInstance();
		$this->template = new Template();
		$this->repo = new Repository();
		$this->session = Session::getInstance();
		$this->vars = SaveVars::getInstance();
		ShoppingCart::getInstance();
	}
	
	private function getDefaultViewName() {
		return strtolower(preg_replace('~Controller$~i', '', get_class($this)));
	}
	
	protected function view($name = NULL, $data = NULL) {
		if (!isset($name)) {
			$name = $this->getDefaultViewName();
		}
		$this->template->view($name, $data);
	}
	
	protected function addData($data) {
		$this->template->addData($data);
	}
	
	/**
	 * Redirect a user.
	 */
	protected function redirect($location, $appendLanguage = TRUE) {
		// remove trailing slash
		$location = preg_replace('~^/~', '', $location);
		// append language?
		if ($appendLanguage) {
			$location = $this->lang->getLanguage() . '/' . $location;
		}
		header('Location: ' . '/' . $location);
	}
	
	/*
	* Gets the logged in user
	*/
	protected function getUser() {
		return $this->session->getUser();
	}
	
	/**
	 * Is a user logged in.
	 */
	protected function isLoggedIn() {
		return $this->session->isLoggedIn();
	}
	
	/**
	 * Is a user logged in.
	 */
	protected function assertUserIsLoggedIn() {
		$this->session->assertUserIsLoggedIn();
	}

	/**
	 * Is the debug mode on.
	 */
	protected function isDebug() {
		return $this->config['debug'] == true;
	}
}

?>
