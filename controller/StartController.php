<?php

/*
 * Abstract class for MVC controllers.
 */
class StartController extends MainController {

	public function __construct() {
		parent::__construct();
		$this->vars->save_global('category',SaveVars::T_INT,SaveVars::G_GET);
		$this->vars->save_global('searchstring',SaveVars::T_STRING,SaveVars::G_GET);
	}

	public function index() {
		// get variables
		$categoryId = $this->vars->category;
		$searchstring = $this->vars->searchstring;
		
		// load data
		$categories = $this->repo->getAllCategories();
		$products = array();
		if (isset($categoryId)){
			$products = $this->repo->getProductsByTagId($categoryId, $searchstring);
		} else {
			$products = $this->repo->getProductsBySearch($searchstring);
		}
		$product = ProductQuery::create()->findPk(1);
		$reviews = $this->repo->getReviewsByProduct($product);
		
		// set data for view
		$data['categories'] = $categories;
		$data['products'] = $products;
		$data['reviews'] = $reviews;
		$data['active_category'] = $categoryId;
		
		// render template
		$this->view('start', $data);
	}	
}

?>
