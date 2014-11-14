<?php

/*
 * Get information to a product
 */
class ProductController extends MainController {

	public function __construct() {
		parent::__construct();
		$this->vars->save_global('product_id',SaveVars::T_INT,SaveVars::G_GET);
	}

	public function index() {
		
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
}

?>
