<?php

/*
 * Get information to a product
 */
class ProductController extends MainController {

	public function __construct() {
		parent::__construct();
		
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
		// TODO: validate strings
		$this->vars->saveGlobal('product_id', SaveVars::T_NUMERIC, SaveVars::G_POST);
		$this->vars->saveVar('product', SaveVars::T_OBJECT, $this->repo->getProductById($this->vars->product_id), function(){
			return (new Product())->setActive(true);
		});
		$this->vars->saveGlobal('product_name', SaveVars::T_STRING, SaveVars::G_POST);
		$this->vars->saveGlobal('product_description', SaveVars::T_STRING, SaveVars::G_POST, function(){
			return $this->vars->product->getDescription();
		});
		$this->vars->saveGlobal('product_categories', SaveVars::T_STRING, SaveVars::G_POST, function(){
			$product_categories = NULL;
			foreach($this->vars->product->getCategories() as $category){
				$product_categories .= $category->getId() . ',';
			}
			rtrim($product_categories, ",");
			return $product_categories;
		});
		$this->vars->saveGlobal('product_programminglanguages', SaveVars::T_STRING, SaveVars::G_POST, function(){
			$product_programmingLanguages = NULL;
			foreach($this->vars->product->getProgrammingLanguages() as $programmingLanguage){
				$product_programmingLanguages .= $programmingLanguage->getId() . ',';
			}
			rtrim($product_programmingLanguages, ",");
			return $product_programmingLanguages;
		});
		$this->vars->saveGlobal('product_price', SaveVars::T_NUMERIC, SaveVars::G_POST, function(){
			return $this->vars->product->getPrice();
		});
		$this->vars->saveGlobal('product_file', SaveVars::T_ARRAY_UPLOADED_FILE, SaveVars::G_FILES);
		$file = $this->vars->product_file;
	
		$con = Propel::getConnection();
		$con->beginTransaction();
		try {
			$product = $this->vars->product;
			foreach ($this->lang->getAllLocales() as $locale) {
				$product
					->setLocale($locale)
						->setName($this->vars->product_name)
						->setDescription($this->vars->product_description);
			}
			$categoryIds = split_to_ints($this->vars->product_categories);
			if (count($categoryIds) > 0) {
				foreach ($categoryIds as $categoryId) {
					$category = TagQuery::create()->getCategory($categoryId);
					if (isset($category)) {
						$product->addTag($category);
					}
				}
			}
			$product->save();
			
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
			$this->redirect('product/offers');
			
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
