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
		parent::main();
		$this->show();
	}
	
	public function show() {
		parent::main();
		// get variables
		$searchstring = $this->vars->search;
		$categoryId = $this->vars->categoryId;
		
		// load data
		$products = array();
		if ($categoryId >= 0){
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
		parent::main('product/orders');
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
		parent::main('product/offers');
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
	
	public function add() {
		parent::main();
		$this->assertUserIsLoggedIn();
		
		$this->view('product_add');
	}
	
	public function save() {
		parent::main();
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
			$this->redirect('product/show');
			
		} catch (Exception $e) {
			$con->rollback();
			throw $e;
		}
	}
	
	public function toShoppingCart($offerId) {
		parent::main();
		$this->assertUserIsLoggedIn();
		
		$offerId = intval($offerId);
		if ($offerId > 0) {
		
			$offer = OfferQuery::create()
				->filterById($offerId)
				->filterByActive(TRUE)
				->findOne();
			if (!isset($offer)) {
				throw new Exception('no active offer with this id.');
			}
			
			$user = $this->getUser();
			if ($user->hasOffer($offer)) {
				throw new Exception('user already bought this.');
			}
			
			// add to shopping cart
			$cart = ShoppingCart::getInstance();
			$cart->addOffer($offer);
		}
		
		// redirect
		$this->redirect('product/orders');
	}
	
	public function buy() {
		parent::main();
		$this->assertUserIsLoggedIn();
		
		$user = $this->getUser();
		$cart = ShoppingCart::getInstance();
		
		// make order
		$offers = $cart->getOffers();
		$this->repo->saveOrder($offers, $user);
		
		// clear shopping cart
		$cart->clear();
		
		// redirect
		$this->redirect('product/orders');
	}
}

?>
