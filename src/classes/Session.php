<?php

/*
 * Class for user session management.
 */
class Session {

	/**
	 * Singleton.
	 */
	private static $instance;
	public static function getInstance() {
		if (!isset(self::$instance)) {
			self::$instance = new self;
		}
		return self::$instance;
	}

	private $vars;
	private $gitkit;

	private function __construct() {
		global $config;

		$this->config = $config;
		
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
		}, TRUE);
	}
	
	/*
	* Gets the logged in user
	*/
	public function getUser() {
		$user = NULL;
		$gitkitUser = $this->vars->gitkitUser;
		if (isset($gitkitUser) && array_key_exists('email',$gitkitUser) && array_key_exists('token',$gitkitUser)){
			$repo = new Repository();
			$user = $repo->getUserByToken($gitkitUser['token']);
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
	public function isLoggedIn() {
		$user = $this->getUser();
		return isset($user) && $user->getActive();
	}
	
	/**
	 * Is a user logged in.
	 */
	public function assertUserIsLoggedIn() {
		if (!$this->isLoggedIn()) {
			throw new SecurityException();
		}
	}
}

?>