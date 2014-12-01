<?php

/*
 * Abstract class for MVC controllers.
 */
class StartController extends MainController {

	public function __construct() {
		parent::__construct();
	}

	public function index() {
		$this->show();
	}
	
	public function show() {
		parent::index();
		// get variables
		$searchstring = $this->vars->search;
		$categoryId = $this->vars->categoryId;
		
		// load data
		$products = array();
		if ($categoryId >= 0){
			$products = $this->repo->getProductsByTagId($categoryId, $searchstring);
		} else {
			$products = $this->repo->getProductsBySearch($searchstring);
		}
		foreach($products as $product){
			$product->setLocale($this->lang->getLocale());
		}
		// set data for view
		$data['pageTitle'] = label('products');
		$data['products'] = $products;
		
		// render template
		$this->view('start', $data);
	}

	public function codes() {
		// todo: maybe in own controller?
		$this->show();
	}
	
	public function products() {
		// todo: maybe in own controller?
		$this->show();
	}
	
	public function add() {
		// todo: maybe in own controller?
		$this->show();
	}
	
	public function signin(){
		$this->vars->fallback('gitkitUser'); // fallback to gitkit user token
		$this->vars->userIsLoggedIn = true;
		$this->show();
	}

	public function signout(){
		$this->vars->fallback('gitkitUser'); // fallback to gitkit user token
		$this->vars->userIsLoggedIn = false;
		$this->show();
	}
}

?>
