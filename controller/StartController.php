<?php

/*
 * Abstract class for MVC controllers.
 */
class StartController extends MainController {

	public function __construct() {
		parent::__construct();
	}

	public function index() {	
		// get variables
		$categoryId = $this->get('category');
		$searchstring = $this->get('search');
		
		// load data
		$categories = $this->repo->get_all_categories();
		$products = array();
		if (isset($categoryId)){
			$products = $this->repo->get_products_by_tag_id($categoryId, $searchstring);
		} else {
			$products = $this->repo->get_products($searchstring);
		}
		
		// set data for view
		$data['categories'] = $categories;
		$data['products'] = $products;
		$data['active_category'] = $categoryId;
		
		// render template
		$this->view('start', $data);
	}	
}

?>