<?php

/*
 * Get information to a product
 */
class ProductController extends MainController {

	public function __construct() {
		parent::__construct();
		
		$this->vars->saveGlobal('product_id', SaveVars::T_INT, SaveVars::G_POST, function(){
			return -1;
		});
		$this->vars->saveGlobal('product_name', SaveVars::T_STRING, SaveVars::G_POST, function(){
			return '';
		});
		$this->vars->saveGlobal('product_description', SaveVars::T_STRING, SaveVars::G_POST, function(){
			return '';
		});
		$this->vars->saveGlobal('product_categories', SaveVars::T_STRING, SaveVars::G_POST, function(){
			return '';
		});
		$this->vars->saveGlobal('product_programminglanguages', SaveVars::T_STRING, SaveVars::G_POST, function(){
			return '';
		});
		$this->vars->saveGlobal('product_price', SaveVars::T_INT, SaveVars::G_POST, function(){
			return -1;
		});
		$this->vars->saveGlobal('product_file', SaveVars::T_ARRAY, SaveVars::G_FILES, function(){
			return array();
		});
		$this->vars->saveGlobal('offer_id', SaveVars::T_INT, SaveVars::G_GET, function(){
			return -1;
		});
	}

	public function index() {
		parent::index();
	}
	
	public function orders() {
		parent::index();
		$this->assertUserIsLoggedIn();
				
		// get variables		
		$searchstring = $this->vars->search;
		$categoryId = $this->vars->categoryId;
		$user = $this->getUser();
		if (strlen($searchstring) == 0) {
			$searchstring = NULL;
		}
		if ($categoryId < 0) {
			$categoryId = NULL;
		}
		
		// load data
		$products = $this->repo->getUsersOrders($categoryId, $searchstring, $user);

		foreach ($products as $product){
			$product->setLocale($this->lang->getLocale());
		}
		
		// set data for view
		$data['pageTitle'] = label('navMyItems');
		$data['products'] = $products;
		
		// render template
		$this->view('start', $data);
	}
	
	public function offers() {
		parent::index();
		$this->assertUserIsLoggedIn();
				
		// get variables		
		$searchstring = $this->vars->search;
		$categoryId = $this->vars->categoryId;
		$user = $this->getUser();
		if (strlen($searchstring) == 0) {
			$searchstring = NULL;
		}
		if ($categoryId < 0) {
			$categoryId = NULL;
		}
		
		// load data
		$products = $this->repo->getUsersOffers($categoryId, $searchstring, $user);
		
		foreach ($products as $product){
			$product->setLocale($this->lang->getLocale());
		}
		
		// set data for view
		$data['pageTitle'] = label('navMyProducts');
		$data['products'] = $products;
		
		// render template
		$this->view('start', $data);
	}
	
	public function add() {
		parent::index();
		$this->assertUserIsLoggedIn();
		$this->view('add_product');
	}
	
	public function save() {
		parent::index();
		$this->assertUserIsLoggedIn();

		$user = $this->getUser();

		// validate...
		$file = $this->vars->product_file;
		if (!isset($file)) {
			throw new Exception('no file uploaded');
		}		
		if (!is_uploaded_file($file['tmp_name'])) {
			throw new Exception('no file uploaded');
		}
		if ($file['error'] != UPLOAD_ERR_OK) {
			$message = 'Error uploading file';
			switch($file['error']) {
				case UPLOAD_ERR_INI_SIZE:
				case UPLOAD_ERR_FORM_SIZE:
					throw new Exception('file too large');
				case UPLOAD_ERR_PARTIAL:
					throw new Exception('file upload was not completed.');
				case UPLOAD_ERR_NO_FILE:
					throw new Exception('zero-length file uploaded');
				default:
					throw new Exception('internal error');
			}
		}
		
		// TODO: validate all!
	
		$con = Propel::getConnection();
		$con->beginTransaction();
		try {
			// load product if exists
			$product = ProductQuery::create()->findPk($this->vars->product_id);
			if (!isset($product)) {
				// create product, it doesn't already exist
				$product = new Product();
				foreach ($this->lang->getAllLocales() as $locale) {
					$product
						->setLocale($locale)		
							->setName($this->vars->product_name)
							->setDescription($this->vars->product_description);
				}
				$product->setActive(true);
				
				$product->save();
				
				// categories
				$categoryIds = split_to_ints($this->vars->product_categories);
				if (count($categoryIds) > 0) {
					foreach ($categoryIds as $categoryId) {
						$category = TagQuery::create()->getCategory($categoryId);
						if (isset($category)) {
							$product->addTag($category);
						}
					}
					$product->save();
				}
			}
			
			// offer
			$offer = new Offer();
			$offer
				->setProduct($product)
				->setPrice($this->vars->product_price)
				->setActive(true)
				->save();
			
			// programming languages
			$plIds = split_to_ints($this->vars->product_programminglanguages);
			if (count($plIds) > 0) {
				foreach ($plIds as $plId) {
					$pl = TagQuery::create()->getProgrammingLanguage($plId);
					if (isset($pl)) {
						$offer->addTag($pl);
					}
				}
				$offer->save();
			}
			
			// code
			$code = new Code();
			$code
				->setUser($user)
				->setOffer($offer)
				->setFilename($file['name'])
				->setFilesize($file['size'])
				->setMimetype($file['type'])
				->setContent(file_get_contents($file['tmp_name']))
				->setActive(true)
				->save();

			$con->commit();
			
			// redirect
			$this->redirect('/start');
			
		} catch (Exception $e) {
			$con->rollback();
			throw $e;
		}
	}
	
	public function order() {
		parent::index();
		$this->assertUserIsLoggedIn();
		
		// collect data...
		$offerId = $this->vars->offer_id;
		$user = $this->getUser();
		
		$this->repo->saveOrder($offerId, $user);
			
		// redirect
		$this->redirect('/product/orders');
	}
}

?>
