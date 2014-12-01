<?php

/*
 * Do a search
 */
class SearchController extends MainController {

	public function __construct() {
		parent::__construct();
	}

	public function index() {
		parent::index();	
		
		// get variables		
		$searchstring = $this->vars->search;
		
		// load data
		$products = array();
		if (isset($categoryId)){
			$products = $this->repo->getProductsByTagId($categoryId, $searchstring);
		} else {
			$products = $this->repo->getProductsBySearch($searchstring);
		}
		$product = ProductQuery::create()->findPk(1);
		$reviews = $this->repo->getReviewsByProduct($product);
		
		// set data for view
		$data['pageTitle'] = label('products');
		$data['products'] = $products;
		$data['reviews'] = $reviews;
		
		// render template
		$this->view('start', $data);
	}	
}

?>
