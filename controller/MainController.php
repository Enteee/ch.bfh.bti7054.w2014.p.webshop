<?php

/*
 * Abstract class for MVC controllers.
 */
class MainController extends Controller {

	public function __construct() {
		parent::__construct();
		
		// save variables
		$this->vars->saveGlobal('categoryId',SaveVars::T_INT,SaveVars::G_GET,function(){
			return -1;
		});

		$this->vars->saveGlobal('search',SaveVars::T_STRING,SaveVars::G_GET, function(){
			return '';
		});
	}

	protected function main($searchAction = 'product/show'){
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
			$navItems[] = array('url' => lang() . '/products/orders', 'text' => label('navMyOrders'), 'icon' => 'glyphicon-user');
			$navItems[] = array('url' => lang() . '/products/offers', 'text' => label('navMyOffers'), 'icon' => 'glyphicon-folder-open');
			$navItems[] = array('url' => lang() . '/products/add', 'text' => label('navAddOffer'), 'icon' => 'glyphicon-plus');
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
