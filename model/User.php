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
	public function hasOffer($offerNeedle) {
		if (!isset($offerNeedle)) {
			throw new Exception('offerNeedle is null.');
		}
		$orders = $this->getOrders();
		foreach ($orders as $order) {
			if ($order->getOffer() == $offerNeedle) {
				return true;
			}
		}
		return false;
	}
}
