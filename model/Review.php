<?php



/**
 * Skeleton subclass for representing a row from the 'review' table.
 *
 *
 *
 * You should add additional methods to this class to meet the
 * application requirements.  This class will only be generated as
 * long as it does not already exist in the output directory.
 *
 * @package    propel.generator.model
 */
class Review extends BaseReview implements JsonSerializable
{
	public function jsonSerialize(){
		return [
			'text' => $this->getText(),
			'rating' => $this->getRating(),
			'createdAt' => $this->getCreatedAt(),
			'updatedAt' => $this->getUpdatedAt(),
			'email' => $this->getUser()->getEmail(),
		];
	}
}
