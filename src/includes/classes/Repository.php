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
		return ProductQuery::create()
			->useI18nQuery('en_US') // TODO: make language dynamic
				->filterByName($searchstring)
			->endUse()
			->find();
	}

	public function get_products_by_tag_id($tag_id, $searchstring = NULL) {
		$tag = TagQuery::create()
			->findPk($tag_id);

		if (isset($searchstring)) {
			return ProductQuery::create()
				->useI18nQuery('en_US') // TODO: make language dynamic
					->filterByName($searchstring)
				->endUse()	
				->useProductTagQuery()
					->filterByTag($tag)
				->endUse()
				->find();
		} else {
			return ProductQuery::create()
				->useProductTagQuery()
					->filterByTag($tag)
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
