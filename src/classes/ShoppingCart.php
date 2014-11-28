<?php

class ShoppingCart {
	
	private static $cart;
	private $offerIds = array();
	
	public static function get() {
		if (isset(self::$cart)) {
			return self::$cart;
		}
		self::$cart = new ShoppingCart();
		self::$cart->load();
		return self::$cart;
	}
	
	public function addOffer(Offer $offer) {
		$this->offerIds[] = $offer->getId();
	}
	
	public function removeOffer(Offer $offer) {
		$id = $offer->getId();
		if (in_array($id)) {
			unset($this->offerIds[$id]);
		}
		$offerIds[] = $id;
	}
	
	public function getOffers() {
		return OfferQuery::create()
			->find();
	}
	
	public function getTotalPrice() {
		$offer = OfferQuery::create()
			->withColumn('SUM(price)', 'Sum')
			->findOne();
		if (isset($offer)) {
			return $offer->getSum();
		}
		return 0;
	}
	
	private static function load() {
		if (isset($_SESSION['ShoppingCart'])) {
			$this->offerIds = unserialize($_SESSION['ShoppingCart']);
		}
	}
	
	public function save() {
		$_SESSION['ShoppingCart'] = serialize($this->offerIds);
	}
}

?>