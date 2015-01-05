<?php



/**
 * Skeleton subclass for representing a row from the 'offer' table.
 *
 *
 *
 * You should add additional methods to this class to meet the
 * application requirements.  This class will only be generated as
 * long as it does not already exist in the output directory.
 *
 * @package    propel.generator.model
 */
class Offer extends BaseOffer implements JsonSerializable
{
	public function jsonSerialize() {
		return [
			'id' => $this->getId(),
			'productId' => $this->getProduct()->getId(),
			'price' => $this->getPrice(),
			'programmingLanguages' => $this->getProgrammingLanguages(),
		];
	}

	public function getProviderUser() {
		if ($this->countCodes() > 0) {
			// user of first uploaded code of this offer
			return $this->getCodes()[0]->getUser();
		}
		// no uploaded code files yet
		return NULL;
	}
	
	public function canBeOrdered() {
		if (Session::getInstance()->isLoggedIn()) {
			return TRUE;
		}
		return FALSE;
	}
	
	public function getProgrammingLanguages() {
		$repo = new Repository();
		return $repo->getProgrammingLanguagesByOffer($this);
	}
}
