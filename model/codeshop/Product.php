<?php



/**
 * Skeleton subclass for representing a row from the 'product' table.
 *
 *
 *
 * You should add additional methods to this class to meet the
 * application requirements.  This class will only be generated as
 * long as it does not already exist in the output directory.
 *
 * @package    propel.generator.codeshop
 */
class Product extends BaseProduct
{
	public function getTags() {
		$repo = new Repository();
		return $repo->getTagsByProduct($this);
	}
	
	public function getProgrammingLanguages() {
		$repo = new Repository();
		return $repo->getProgrammingLanguagesByProduct($this);
	}
	
	public function getVersions() {
		$repo = new Repository();
		return $repo->getVersionsByProduct($this);
	}
}
