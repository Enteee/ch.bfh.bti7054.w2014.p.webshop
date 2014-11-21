<?php

/*
 * Abstract class for MVC controllers.
 */
class RestController extends Controller {

	public function __construct() {
		parent::__construct();
		$this->vars->save_global('product_id', SaveVars::T_INT, SaveVars::G_GET);
		$this->vars->save_global('search', SaveVars::T_STRING, SaveVars::G_GET);
	}

	public function index() {
		$data['json'] = '';
		
		$this->view('json', $data);
	}

	public function getproduct() {
		
		// get variables
		$product_id = $this->vars->product_id;
		
		// load data
		$product = $this->repo->getProductById($product_id);
		if(isset($product)){
			$product->setLocale($this->lang->getLocale());
		}
		// set data for view
		$data['json'] = $product;
		
		// render template
		$this->view('json', $data);
	}
	
	public function products_ac() {
		$products = $this->repo->getProductsBySearch($this->vars->search);
		
		$response = array();		
		foreach ($products as $product) {
			$product->setLocale($this->lang->getLocale());
			$response[] = [
				'value' => $product->getName(),
				'data' => $product->getId()
			];
		}
			
		$data['json'] = $response;

		$this->view('json', $data);
	}

	public function categories_ac() {
		$categories = $this->repo->getCategoriesBySearch($this->vars->search);
		
		$response = array();		
		foreach ($categories as $category) {
			$category->setLocale($this->lang->getLocale());
			$response[] = [
				'value' => $category->getName(),
				'data' => $category->getId()
			];
		}
			
		$data['json'] = $response;

		$this->view('json', $data);
	}
}

?>
