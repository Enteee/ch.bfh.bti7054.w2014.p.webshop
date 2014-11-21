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
				$user->setEmail($gitkitUser->getEmail());
				$user->setToken($gitkitUser->getUserId());
				$user->setCreadits(0);
				$user->setActive(TRUE);
				
				$user->save();
			}
			return $user;			
		}
		
		// TODO: remove!
		// only user for testing because gitkit doesn't work!
		return UserQuery::create()->findPk(1);		
		
		// not logged in
		return NULL;
	}
	
	protected function isLoggedIn() {
		return $this->getUser() != NULL;
	}
}

?>
