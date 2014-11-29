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
		$this->vars->save_global('user', SaveVars::T_OBJECT, SaveVars::G_SESSION,function(){
			$user = NULL;
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
			}
			return $user;
		});
	}
	
	protected function view($name = NULL, $data = NULL) {
		$this->template->view($name, $data);
	}
	
	protected function addData($data) {
		$this->template->addData($data);
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
		return $this->vars->user != NULL;
	}
	
	/**
	 * Is a user logged in.
	 */
	protected function assertUserIsLoggedIn() {
		if (!$this->isLoggedIn()) {
			throw new SecurityException();
		}
	}

	/**
	 * Is the debug mode on.
	 */
	protected function isDebug() {
		return $this->config['debug'] == true;
	}
}

?>
