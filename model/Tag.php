<?php



/**
 * Skeleton subclass for representing a row from the 'tag' table.
 *
 *
 *
 * You should add additional methods to this class to meet the
 * application requirements.  This class will only be generated as
 * long as it does not already exist in the output directory.
 *
 * @package    propel.generator.model
 */
class Tag extends BaseTag implements JsonSerializable
{
	const USER_TAG = 1;
	const CATEGORY = 2;
	const PROGRAMMING_LANGUAGE = 3;

	public function jsonSerialize(){
		return [
			'name' => $this->getName(),
		];
	}

	public function getProductsCount() {
		$repo = new Repository();
		return $repo->getProductCountByTag($this);
	}
}
