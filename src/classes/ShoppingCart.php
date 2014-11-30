<?php

class ShoppingCart {
	
	private static $cart;
	private $vars;

	private function __construct(){
		$this->vars = SaveVars::getInstance();
		$this->vars->saveGlobal('offerIds', SaveVars::T_ARRAY, SaveVars::G_SESSION, function(){
			return array();
		});
	}

	public static function getInstance() {
		if (!isset(self::$cart)) {
			self::$cart = new self;
		}
		return self::$cart;
	}
	
	public function addOffer(Offer $offer) {
		$this->vars->offerIds[] = $offer->getId();
	}
	
	public function removeOffer(Offer $offer) {
		$id = $offer->getId();
		if(in_array($id,$this->vars->offerIds)) {
			unset($this->offerIds[$id]);
		}
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
}

?>
