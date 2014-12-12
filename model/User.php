<?php



/**
 * Skeleton subclass for representing a row from the 'user' table.
 *
 *
 *
 * You should add additional methods to this class to meet the
 * application requirements.  This class will only be generated as
 * long as it does not already exist in the output directory.
 *
 * @package    propel.generator.model
 */
class User extends BaseUser
{
	public function hasOffer(Offer $offer) {
		if (!isset($offer)) {
			throw new InvalidArgumentException('offer is null.');
		}
		$count = OrderQuery::create()
			->filterByUser($this)
			->filterByOffer($offer)
			->filterByActive(TRUE)
			->count();
		return $count > 0;
	}
}
