<?php

class Repository {

	public function getAllCategories() {
		return TagQuery::create()
			->find();
	}

	public function getAllProducts() {
		return ProductQuery::create()
			->find();	
	}

	public function getProductsBySearch($searchstring = NULL) {
		if (isset($searchstring)) {
			return ProductQuery::create()
				->filterByName($searchstring)
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
		$tagType = TagTypeQuery::create()->findPk(3); // programming languages
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
	
	public function getCommentsByProduct($product) {
		return CommentQuery::create()
			->filterByProduct($product)
			->find();
	}
}
?>
