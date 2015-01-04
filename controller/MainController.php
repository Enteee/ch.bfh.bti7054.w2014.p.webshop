<?php

/*
 * Abstract class for MVC controllers.
 */
class MainController extends Controller {

	public function __construct() {
		parent::__construct();

		// save variables
		$this->vars->saveGlobal('categoryId', SaveVars::T_NUMERIC, SaveVars::G_GET, function(){
			return NULL;
		}, true);

		$this->vars->saveGlobal('search', SaveVars::T_STRING, SaveVars::G_GET, function(){
			return NULL;
		}, true);
	}

	protected function main($searchAction = 'products/show'){
		// set global data for view
		$data['title'] = $this->lang->title;
		$data['subtitle'] = $this->lang->subtitle;
		$data['author'] = $this->config['author'];
		$data['contact'] = $this->config['mail'];
		$data['metadata'] = array(
			'keywords' => 'codeshop,code,shop,snippets,buy'
		);
		$data['locale'] = $this->lang->getLocale();
		$data['isLoggedIn'] = $this->isLoggedIn();
		
		// search 
		$data['searchAction'] = $searchAction;
		$data['searchTerm'] = $this->vars->search;
		
		// navigation
		$navItems = array();
		if ($this->isLoggedIn()) {
			$navItems[] = array(
				'url' => lang() . '/products/orders',
				'text' => label('navMyOrders'),
				'icon' => 'glyphicon-user',
				'active' => (Mvc::getInstance()->getControllerName() == 'ProductsController' && Mvc::getInstance()->getMethod() == 'orders') ? 'active' : '',
			);
			$navItems[] = array(
				'url' => lang() . '/products/offers',
 				'text' => label('navMyOffers'),
				'icon' => 'glyphicon-folder-open',
				'active' => (Mvc::getInstance()->getControllerName() == 'ProductsController' && Mvc::getInstance()->getMethod() == 'offers') ? 'active' : '',
			);
			$navItems[] = array(
				'url' => lang() . '/product/add',
				'text' => label('navAddOffer'),
				'icon' => 'glyphicon-plus',
				'active' => (Mvc::getInstance()->getControllerName() == 'ProductController' && Mvc::getInstance()->getMethod() == 'add' ) ? 'active' : '',
			);
		}
		$data['navItems'] = $navItems;
		
		// user details
		$data['userCredits'] = 0;
		if ($this->isLoggedIn()) {
			$data['userCredits'] = $this->getUser()->getCredits();
		}
		
		// side nav
		$categories = $this->repo->getAllCategories();
		$data['categories'] = $categories;
		$data['activeCategoryId'] = $this->vars->categoryId;
		
		// shopping cart
		$shoppingCartItems = array();
		$shoppingCartTotal = 0;
		if ($this->isLoggedIn()) {
			$shoppingCart = ShoppingCart::getInstance();
			$shoppingCartItems = $shoppingCart->getOffers();
			$shoppingCartTotal = $shoppingCart->getTotalPrice();
		}
		$data['shoppingCartItems'] = $shoppingCartItems;
		$data['shoppingCartTotalPrice'] = $shoppingCartTotal;
		
		$this->addData($data);
	}
}

?>
