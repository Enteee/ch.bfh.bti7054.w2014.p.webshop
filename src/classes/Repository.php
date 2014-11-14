<?php

class Repository {

	public function getAllCategories() {
		$tagType = TagTypeQuery::create()->findPk(Tag::CATEGORY);
		return TagQuery::create()
			->filterByTagType($tagType)
			->find();
	}

	public function getAllProducts() {
		return ProductQuery::create()
			->find();	
	}

public function getProductById($product_id) {
		return ProductQuery::create()
			->findPk($product_id);
	}

	public function getProductsBySearch($searchstring = NULL) {
		if (isset($searchstring)) {
			return ProductQuery::create()
				->useProductI18nQuery()
					->filterByName('%' . $searchstring . '%')
				->endUse()
				->find();
		} else {
			return ProductQuery::create()
				->find();
		}
	}

	public function getProductsByTagId($tag_id, $searchstring = NULL) {
		if (isset($searchstring)) {
			return ProductQuery::create()
				->filterByName($searchstring)
				->useProductTagQuery()
					->filterByTagId($tag_id)
				->endUse()
				->find();
		} else {
			return ProductQuery::create()
				->useProductTagQuery()
					->filterByTagId($tag_id)
				->endUse()
				->find();
		}
	}
	
	public function getProductCountByTag($tag) {
		return ProductTagQuery::create()
			->filterByTag($tag)
			->count();
	}
	
	public function getTagsByProduct($product) {
		return TagQuery::create()
			->useProductTagQuery()
				->filterByProduct($product)
			->endUse()
			->find();
	}
	
	public function getProgrammingLanguagesByProduct($product) {
		$tagType = TagTypeQuery::create()->findPk(Tag::PROGRAMMING_LANGUAGE);
		return TagQuery::create()
			->useProductTagQuery()
				->filterByProduct($product)
			->endUse()
			->filterByTagType($tagType)
			->find();
	}
	
	public function getVersionsByProduct($product) {
		return CodeQuery::create()
			->useOfferQuery()
				->filterByProduct($product)
			->endUse()
			->find();
	}
	
	public function getReviewsByProduct($product) {
		if (isset($product)) {
			return ReviewQuery::create()
				->filterByProduct($product)
				->find();
		} else {
			return array();
		}
	}
}
?>
