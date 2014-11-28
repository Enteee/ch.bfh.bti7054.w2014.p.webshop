<?php

/*
 * Abstract class for MVC controllers.
 */
class StartController extends MainController {

	public function __construct() {
		parent::__construct();
		$this->vars->save_global('category',SaveVars::T_INT,SaveVars::G_GET);
		$this->vars->save_global('search',SaveVars::T_STRING,SaveVars::G_GET);
	}

	public function index() {
		$this->show();
	}
	
	public function show() {
				
		// get variables		
		$searchstring = $this->vars->search;
		$categoryId = $this->categoryId;
		
		// load data
		$products = array();
		if (isset($categoryId)){
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
}

?>
