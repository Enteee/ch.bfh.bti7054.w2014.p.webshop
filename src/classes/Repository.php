<?php

class Repository {

	public function get_all_categories() {
		return TagQuery::create()
			->find();
	}

	public function get_all_products() {
		return ProductQuery::create()
			->find();	
	}

	public function get_products($searchstring = NULL) {
		if (isset($searchstring)) {
			return ProductQuery::create()
				->filterByName($searchstring)
				->find();
		} else {
			return ProductQuery::create()
				->find();
		}
	}

	public function get_products_by_tag_id($tag_id, $searchstring = NULL) {
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
	
	public function get_product_count_by_tag_id($tag_id) {
		$tag = TagQuery::create()
			->findPk($tag_id);

		return ProductTagQuery::create()
			->filterByTag($tag)
			->count();
	}
	
	public function get_tags_by_product_id($product_id) {
		$product = ProductQuery::create()
			->findPk($product_id);

		return TagQuery::create()
			->useProductTagQuery()
				->filterByProduct($product)
			->endUse()
			->find();
	}	
}
?>
