<?php

/*
 * Get information to a product
 */
class ProductController extends MainController {

	public function __construct() {
		parent::__construct();
		$this->vars->save_global('product_id', SaveVars::T_INT, SaveVars::G_GET);
		$this->vars->save_global('product_name', SaveVars::T_STRING, SaveVars::G_POST);
		$this->vars->save_global('product_description', SaveVars::T_STRING, SaveVars::G_POST);
		$this->vars->save_global('product_categories', SaveVars::T_STRING, SaveVars::G_POST);
		$this->vars->save_global('product_programminglanguages', SaveVars::T_STRING, SaveVars::G_POST);
		$this->vars->save_global('product_tags', SaveVars::T_STRING, SaveVars::G_POST);
		$this->vars->save_global('product_file', SaveVars::T_STRING, SaveVars::G_POST);
	}

	public function index() {
	}
	
	public function add() {
		$data = array();
	
		// render template
		$this->view('add_product', $data);
	}
	
	public function save() {

		// TODO

		$this->add();
	}
}

?>
