<?php

/*
 * Abstract class for MVC controllers.
 */
abstract class Controller {

	protected $config;
	protected $lang;
	protected $template;
	protected $repo;

	public function __construct() {
		global $config;
		
		// init ressource objects
		$this->config = $config; 
		$this->lang = Mvc::$lang;
		$this->template = new Template();
		$this->repo = new Repository();
	}
	
	protected function view($name = NULL, $data = NULL) {
		$this->template->view($name, $data);
	}
	
	protected function addData($data) {
		$this->template->addData($data);
	}
	
	protected function post($key) {
		if (isset($_POST[$key])) {
			return $_POST[$key];
		}
		return NULL; // not set
	}
	
	protected function get($key) {
		if (isset($_GET[$key])) {
			return $_GET[$key];
		}
		return NULL; // not set
	}
}

?>