<?php

class ShoppingCart {
	
	private static $cart;
	private $vars;

	private function __construct(){
		$this->vars = SaveVars::getInstance();
		$this->vars->saveGlobal('shoppingCartOfferIds', SaveVars::T_ARRAY, SaveVars::G_SESSION, function() { 
			return array();
		}, false);
	}

	public static function getInstance() {
		if (!isset(self::$cart)) {
			self::$cart = new self;
		}
		return self::$cart;
	}
	
	public function addOffer(Offer $offer) {
		if (!isset($offer)) {
			throw new InvalidArgumentException('offer is null.');
		}
		$offerId = $offer->getId();

		$offerIds = $this->vars->shoppingCartOfferIds;
		if (!isset($offerIds)) {
			$offerIds = array();
		}
		if (!array_key_exists($offerId, $offerIds)) {
			$offerIds[$offerId] = 1;
			$this->vars->shoppingCartOfferIds = $offerIds;
		}
	}
	
	public function containsOffer(Offer $offer) {
		if (!isset($offer)) {
			throw new InvalidArgumentException('offer is null.');
		}
		$offerId = $offer->getId();
		
		$offerIds = $this->vars->shoppingCartOfferIds;
		if (!isset($offerIds)) {
			$offerIds = array();
		}
		return isset($offerIds[$offerId]) && $offerIds[$offerId] > 0;
	}
	
	public function removeOffer(Offer $offer) {
		if (!isset($offer)) {
			throw new InvalidArgumentException('offer is null.');
		}
		
		$offerIds = $this->vars->shoppingCartOfferIds;
		if (!isset($offerIds)) {
			$offerIds = array();
		}
		
		if ($this->containsOffer($offer)) {
			$id = $offer->getId();
			unset($offerIds[$id]);
			$this->vars->shoppingCartOfferIds = $offerIds;
		}
	}
	
	public function getOffers() {
		$offerIds = $this->vars->shoppingCartOfferIds;
		if (!isset($offerIds)) {
			$offerIds = array();
		}
		return OfferQuery::create()
			->filterById(array_keys($offerIds))
			->find();
	}
	
	public function getTotalPrice() {
		$offerIds = $this->vars->shoppingCartOfferIds;
		if (!isset($offerIds)) {
			$offerIds = array();
		}
		$offer = OfferQuery::create()
			->filterById(array_keys($offerIds))
			->withColumn('SUM(price)', 'Sum')
			->findOne();
		if (isset($offer)) {
			return $offer->getSum();
		}
		return 0;
	}
	
	public function clear() {
		$this->vars->shoppingCartOfferIds = array();
	}
}

?>
