<?php

/*
 * Get information to a product
 */
class ProductsController extends MainController {

	public function __construct() {
		parent::__construct();
	}

	public function index() {
		$this->show();
	}
	
	public function show() {
		parent::main();
		// get variables
		$searchstring = $this->vars->search;
		$categoryId = $this->vars->categoryId;
		
		// load data
		$products = array();
		if (isset($categoryId) && $categoryId >= 0){
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
		$data['canOrder'] = TRUE;
		
		// render template
		$this->view('product_list', $data);
	}
	
	public function orders() {
		parent::main('products/orders');
		$this->assertUserIsLoggedIn();
		
		// get variables
		$searchstring = $this->vars->search;
		$categoryId = $this->vars->categoryId;
		$user = $this->getUser();
		
		// load data
		$products = $this->repo->getUsersOrders($categoryId, $searchstring, $user);

		foreach ($products as $product){
			$product->setLocale($this->lang->getLocale());
		}
		
		// set data for view
		$data['pageTitle'] = label('navMyOrders');
		$data['products'] = $products;
		$data['canOrder'] = FALSE;
		
		// render template
		$this->view('product_list', $data);
	}
	
	public function offers() {
		parent::main('products/offers');
		$this->assertUserIsLoggedIn();
				
		// get variables
		$searchstring = $this->vars->search;
		$categoryId = $this->vars->categoryId;
		$user = $this->getUser();
		
		// load data
		$products = $this->repo->getUsersOffers($categoryId, $searchstring, $user);
		
		foreach ($products as $product){
			$product->setLocale($this->lang->getLocale());
		}
		
		// set data for view
		$data['pageTitle'] = label('navMyOffers');
		$data['products'] = $products;
		$data['canOrder'] = FALSE;
		
		// render template
		$this->view('product_list', $data);
	}
}

?>
