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
 * @package    propel.generator.model
 */
class Product extends BaseProduct implements JsonSerializable
{
	public function jsonSerialize(){
		return [
			'name' => $this->getName(),
			'tags' => $this->getTags(),
			'categories' => $this->getCategories(),
			'description' => $this->getDescription(),
			'programmingLanguage' => $this->getProgrammingLanguages(),
			'offers' => $this->getOffersByProduct(),
			'reviewsCount' => $this->countReviews(),
			'reviews' => $this->getReviews(),
			'avgRating' => $this->getAvgRating(),
		];
	}

	public function getCategories(){
		return TagQuery::create()
			->filterByTagType(TagType::getCategoryTagType())
			->useProductTagQuery()
				->filterByProduct($this)
			->endUse()
			->find();
	}

	public function getProgrammingLanguages() {
		$repo = new Repository();
		return $repo->getProgrammingLanguagesByProduct($this);
	}
	
	public function getOffersByProduct() {
		$repo = new Repository();
		return $repo->getOffersByProduct($this);
	}

}
