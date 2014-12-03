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
		$this->vars = SaveVars::getInstance();
		$this->vars->saveGlobal('gitkitUser', SaveVars::T_ARRAY, SaveVars::G_SESSION, function(){
			$this->vars->callEnabledSuperglobals(function() use (&$gitkitUser){
				$gitkit = Gitkit_Client::createFromFile($this->config['gitkit']['server-config']);
				$requestUser = $gitkit->getUserInRequest();
				if (isset($requestUser)) {
					$gitkitUser['email'] = $requestUser->getEmail();
					$gitkitUser['token'] = $requestUser->getUserId();
				}
			});
			return $gitkitUser;
		});
		$this->vars->saveGlobal('userIsLoggedIn', SaveVars::T_BOOL, SaveVars::G_SESSION, function(){
			return false;
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

	/*
	* Gets the logged in user
	*/
	protected function getUser(){
		$user = NULL;
		$gitkitUser = $this->vars->gitkitUser;
		if(	array_key_exists('email',$gitkitUser)
			&& array_key_exists('token',$gitkitUser)){
			$user = $this->repo->getUserByToken($gitkitUser['token']);
			if (!isset($user)) {
				// first time login -> create user in db
				$user = new User();
				$user
					->setEmail($gitkitUser['email'])
					->setToken($gitkitUser['token'])
					->setCredits(0)
					->setActive(TRUE)
					->save();
			}
		}
		return $user;
	}
	
	/**
	 * Is a user logged in.
	 */
	protected function isLoggedIn() {
		$user = $this->getUser();
		return 	$this->vars->userIsLoggedIn 
				&& isset($user) 
				&& $user->getActive();
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
