<?php

/*
 * Get information to a product
 */
class OrderController extends MainController {

	public function __construct() {
		parent::__construct();
	}

	public function index() {
		parent::main();
		$this->assertUserIsLoggedIn();
		
		$data['pageTitle'] = label('orderOverview');

		$user = $this->getUser();
		$cart = ShoppingCart::getInstance();
		$totalPrice = $cart->getTotalPrice();
		$items = $cart->getOffers();
		
		$data['items'] = $items;
		$data['totalPrice'] = $totalPrice;
		$data['enoughtCredits'] = $user->getCredits() >= $totalPrice;
		
		if (count($items) == 0) {
			throw new Exception('no items in the shopping cart');
		}
		
		$this->view('order', $data);
	}
	
	public function finish() {
		parent::main();
		$this->assertUserIsLoggedIn();
		
		$user = $this->getUser();
		$cart = ShoppingCart::getInstance();
		
		// make order
		$offers = $cart->getOffers();
		$this->repo->saveOrder($offers, $user);
		
		// clear shopping cart
		$cart->clear();
		
		// send confirm mail
		mail($user->getEmail(), label('confirmMailSubject'), label('confirmMailBody')); 
		
		// redirect
		$this->redirect('products/orders');
	}
}

?>
