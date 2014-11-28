<?php

/*
 * Get information as json
 */
class JsonController extends MainController {

	public function __construct() {
		parent::__construct();
		$this->vars->save_global('type',SaveVars::T_STRING,SaveVars::G_GET);
		$this->vars->save_global('id',SaveVars::T_INT,SaveVars::G_GET);
		$this->vars->save_global('search', SaveVars::T_STRING, SaveVars::G_GET);
	}

	public function index() {
		$object = null;
		switch($this->vars->type){
			case "product":
				$object = $this->repo->getProductById($this->vars->id);
				if(isset($object)){
					$object->setLocale($this->lang->getLocale());
				}
			break;
			case "review":
				$object = $this->repo->getReviewById($this->vars->id);
			break;
			default:
				// do nothing
		}
		$data = [
			'json' => $object,
		];
		// render template
		$this->view('json', $data);
	}
	
	public function products_ac() {
		$products = $this->repo->getProductsBySearch($this->vars->search);
		
		$response = array();		
		foreach ($products as $product) {
			$product->setLocale($this->lang->getLocale());
			$response[] = [
				'data' => $product->getId(),			
				'value' => $product->getName()
			];
		}
			
		$data['json'] = $response;

		$this->view('json', $data);
	}
	
	public function products_select2() {
		$products = $this->repo->getProductsBySearch($this->vars->search);
		
		$response = array();		
		foreach ($products as $product) {
			$product->setLocale($this->lang->getLocale());
			$response[] = [
				'id' => $product->getId(),			
				'text' => $product->getName()
			];
		}
			
		$data['json'] = $response;

		$this->view('json', $data);
	}

	public function categories_select2() {
		$categories = $this->repo->getCategoriesBySearch($this->vars->search);
		
		$response = array();		
		foreach ($categories as $category) {
			$category->setLocale($this->lang->getLocale());
			$response[] = [
				'id' => $category->getId(),
				'text' => $category->getName()
			];
		}
			
		$data['json'] = $response;

		$this->view('json', $data);
	}
	
	public function programminglanguages_select2() {
		$pls = $this->repo->getProgrammingLanguagesBySearch($this->vars->search);
		
		$response = array();		
		foreach ($pls as $pl) {
			$pl->setLocale($this->lang->getLocale());
			$response[] = [
				'id' => $pl->getId(),
				'text' => $pl->getName()
			];
		}
			
		$data['json'] = $response;

		$this->view('json', $data);
	}
}

?>
