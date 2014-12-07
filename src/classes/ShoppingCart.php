<?php

class ShoppingCart {
	
	private static $cart;
	private $vars;

	private function __construct(){
		$this->vars = SaveVars::getInstance();
		$this->vars->saveGlobal('offerIds', SaveVars::T_ARRAY, SaveVars::G_SESSION, function() { return array(); });
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
		if (!in_array($offerId, $this->vars->offerIds)) {
			$ids = $this->vars->offerIds;
			$ids[] = $offerId;
			$this->vars->offerIds = $ids;
		}
	}
	
	public function removeOffer(Offer $offer) {
		$id = $offer->getId();
		if (in_array($id, $this->vars->offerIds)) {
			unset($this->offerIds[$id]);
		}
	}
	
	public function getOffers() {
		return OfferQuery::create()
			->filterById($this->vars->offerIds)
			->find();
	}
	
	public function getTotalPrice() {
		$offer = OfferQuery::create()
			->filterById($this->vars->offerIds)
			->withColumn('SUM(price)', 'Sum')
			->findOne();
		if (isset($offer)) {
			return $offer->getSum();
		}
		return 0;
	}
	
	public function clear() {
		$this->vars->offerIds = array();
	}
}

?>
