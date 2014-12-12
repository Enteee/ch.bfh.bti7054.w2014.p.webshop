<?php

/*
 * Get information as json
 */
class JsonController extends Controller {

	public function __construct() {
		parent::__construct();
		$this->vars->saveGlobal('REQUEST_METHOD',SaveVars::T_STRING,SaveVars::G_SERVER, function(){
			return 'none';
		});
		$this->vars->saveGlobal('type',SaveVars::T_STRING,SaveVars::G_GET, function(){
			return '';
		});
		$this->vars->saveGlobal('id',SaveVars::T_INT,SaveVars::G_GET, function(){
			return -1;
		});
		$this->vars->saveGlobal('search', SaveVars::T_STRING, SaveVars::G_GET, function(){
			return '';
		});
		$this->vars->saveGlobal('object', SaveVars::T_STRING_JSON, SaveVars::G_POST, function(){
			return NULL;
		}, true);
	}

	public function index() {
		$object = null;
			switch($this->vars->REQUEST_METHOD){
			case "GET":
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
			break;
			case "POST":
				switch($this->vars->type){
					case "review":
						$this->assertUserIsLoggedIn();
						$user = $this->getUser();
						$object = $this->vars->object;
						if( isset($object)
							&& isset($object->productId)){
							$this->vars->saveVar('reviewProductId', $object->productId, SaveVars::T_NUMERIC, function(){
								return NULL;
							});
							$product = $this->repo->getProductById($this->vars->reviewProductId);
							if(isset($product)
								&& isset($object->text)
								&& isset($object->rating)){
									$this->vars->saveVar('reviewText', $object->text, SaveVars::T_STRING_HTML, function(){
										return NULL;
									});
									$this->vars->saveVar('reviewRating', $object->rating, SaveVars::T_NUMERIC, function(){
										return NULL;
									});
									$review = (new Review())
										->setProduct($product)
										->setText($this->vars->reviewText)
										->setRating($this->vars->reviewRating)
										->setUser($this->getUser());
									$review->save();
									$object = $review;
							}
						}
					break;
					default:
						// do nothing
				}
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
