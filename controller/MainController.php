<?php

/*
 * Abstract class for MVC controllers.
 */
class MainController extends Controller {

	protected $categoryId;	

	public function __construct() {
		parent::__construct();
		
		// save variables
		$this->vars->save_global('category',SaveVars::T_INT,SaveVars::G_GET);
				
		// get variables
		$this->categoryId = $this->vars->category;

		// set global data for view
		$data['title'] = $this->lang->title;
		$data['subtitle'] = $this->lang->subtitle;
		$data['author'] = $this->config['author'];
		$data['contact'] = $this->config['mail'];
		$data['metadata'] = array(
			'keywords' => 'codeshop,code,shop,snippets,buy'
		);
		$data['locale'] = $this->lang->getLocale();
				
		// navigation
		$navItems = array();
		if ($this->isLoggedIn()) {
			$navItems[] = array('url' => lang() . '/product/orders', 'text' => label('navMyItems'), 'icon' => 'glyphicon-user');
			$navItems[] = array('url' => lang() . '/product/offers', 'text' => label('navMyProducts'), 'icon' => 'glyphicon-folder-open');
			$navItems[] = array('url' => lang() . '/product/add', 'text' => label('navAddProduct'), 'icon' => 'glyphicon-plus');
		}
		$data['navItems'] = $navItems;
		
		// side nav
		$categories = $this->repo->getAllCategories();
		$data['categories'] = $categories;
		$data['activeCategoryId'] = $this->categoryId;
		
		// shopping cart
		$shoppingCartItems = array();
		$shoppingCartTotal = 0;
		if ($this->isLoggedIn()) {
			$shoppingCart = ShoppingCart::get();
			$shoppingCartItems = $shoppingCart->getOffers();
			$shoppingCartTotal = $shoppingCart->getTotalPrice();
		}
		$data['shoppingCartItems'] = $shoppingCartItems;
		$data['shoppingCartTotalPrice'] = $shoppingCartTotal;
		
		$this->addData($data);
	}
}

?>
