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
		$this->redirect('products/');
	}
	
	private function addOffer() {
		$this->vars->saveGlobal('add_offer_id',SaveVars::T_NUMERIC_INT,SaveVars::G_POST,function(){
			return NULL;
		}, true);
		$offerId = $this->vars->add_offer_id;
		if (isset($offerId) && $offerId > 0) {
			$offer = $this->repo->getOfferById($offerId);
			if (!isset($offer)) {
				throw new Exception('no active offer with this id.');
			}
			$this->assertUserIsLoggedIn();
			$user = $this->getUser();
			if ($user->hasOffer($offer)) {
				// throw new Exception('user already bought this.');
				// show no error
				return;
			}
			$cart = ShoppingCart::getInstance();
			if ($cart->containsOffer($offer)) {
				// throw new Exception('user already has this in his shopping cart.');
				// show no error
				return;
			}
			
			// add to shopping cart
			$cart->addOffer($offer);
		}
	}
	
	public function show($productId) {
		// offer added?
		$this->addOffer();
		
		parent::main();
		
		// get variables
		$searchstring = $this->vars->search;
		$productId = intval($productId);
		if ($productId <= 0) {
			throw new NotFoundException();
		}
		
		$product = ProductQuery::create()->findPk($productId);
		if (!isset($product)) {
			throw new NotFoundException();
		}
		
		$product->setLocale($this->lang->getLocale());
		// set data for view
		$data['pageTitle'] = label('products');
		$data['product'] = $product;
		$data['canOrder'] = TRUE;
		$data['hasReviews'] = count($product->getReviews()) > 0;
		
		// render template
		$this->view('product_details', $data);
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
		$this->vars->saveGlobal('product_id', SaveVars::T_NUMERIC_INT, SaveVars::G_POST);
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
		$this->vars->saveGlobal('product_price', SaveVars::T_NUMERIC_INT, SaveVars::G_POST, function(){
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
			$this->show($product->getId());
			
		} catch (Exception $e) {
			$con->rollback();
			throw $e;
		}
	}
}

?>
