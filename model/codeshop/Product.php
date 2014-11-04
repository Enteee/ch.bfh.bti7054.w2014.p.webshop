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
		//$repo = new Repository();
		//return $repo->get_tags_by_product_id($this->getId());
		// TODO:
		return array('Tag1', 'Tag2', 'Tag3');
	}
	
	public function getProgrammingLanguages() {
		// TODO:
		return array('C++', 'Java', 'Perl');
	}
	
	public function getVersions() {
		// TODO:
		return array('alpha', 'beta', '1.0');
	}
}
