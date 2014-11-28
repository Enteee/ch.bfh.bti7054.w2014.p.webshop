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
	private $gitkit;

	public function __construct() {
		global $config;
		
		// init ressource objects
		$this->config = $config; 
		$this->lang = Mvc::$lang;
		$this->template = new Template();
		$this->repo = new Repository();
		$this->vars = new SaveVars();
		$this->gitkit = Gitkit_Client::createFromFile($config['gitkit']['server-config']);
	}
	
	protected function view($name = NULL, $data = NULL) {
		$this->template->view($name, $data);
	}
	
	protected function addData($data) {
		$this->template->addData($data);
	}
	
	protected function getUser() {
		$gitkitUser = $this->gitkit->getUserInRequest();
		if (isset($gitkitUser)) {
			// user logged in
			$token = $gitkitUser->getUserId();
			
			$user = $this->repo->getUserByToken($token);
			if (!isset($user)) {
				// first time login -> create user in db
				$user = new User();
				$user
					->setEmail($gitkitUser->getEmail())
					->setToken($gitkitUser->getUserId())
					->setCreadits(0)
					->setActive(TRUE)
					->save();
			}
			return $user;
		}
		
		if ($this->isDebug()) {
			// testuser
			return UserQuery::create()
				->findPk(1);
		}
		
		// not logged in
		return NULL;
	}
	
	/**
	 * Redirect a user.
	 */
	protected function redirect($location) {
		header('Location: ' . $location);
	}
	
	/**
	 * Is a user logged in.
	 */
	protected function isLoggedIn() {
		return $this->getUser() != NULL;
	}
	
	/**
	 * Is the debug mode on.
	 */
	protected function isDebug() {
		return error_reporting() & E_ERROR;
	}
}

?>
