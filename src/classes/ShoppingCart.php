<?php

class ShoppingCart {
	
	private static $cart;
	private $vars;

	private function __construct(){
		$this->vars = SaveVars::getInstance();
		$this->vars->saveGlobal('shoppingCartOfferIds', SaveVars::T_ARRAY, SaveVars::G_SESSION, function() { return array(); }, FALSE);
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
		if (!in_array($offerId, $offerIds)) {
			$offerIds[] = $offerId;
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
		return in_array($offerId, $offerIds);
	}
	
	public function removeOffer(Offer $offer) {
		if (!isset($offer)) {
			throw new InvalidArgumentException('offer is null.');
		}
		$id = $offer->getId();
		
		$offerIds = $this->vars->shoppingCartOfferIds;
		if (!isset($offerIds)) {
			$offerIds = array();
		}
		if (in_array($id, $offerIds)) {
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
			->filterById($offerIds)
			->find();
	}
	
	public function getTotalPrice() {
		$offerIds = $this->vars->shoppingCartOfferIds;
		if (!isset($offerIds)) {
			$offerIds = array();
		}
		$offer = OfferQuery::create()
			->filterById($offerIds)
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
