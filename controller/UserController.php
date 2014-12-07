<?php

/*
 * Abstract class for MVC controllers.
 */
class UserController extends MainController {

	public function __construct() {
		parent::__construct();
	}

	public function index() {
		$this->show();
	}

	public function signin(){
		$this->vars->fallback('gitkitUser'); // fallback to gitkit user token
		
		$this->redirect('product/show');
	}

	public function signout(){
		$this->vars->fallback('gitkitUser'); // fallback to gitkit user token
		$this->vars->gitkitUser = NULL;
		
		$this->redirect('product/show');
	}
}

?>
