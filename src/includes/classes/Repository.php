<?php

class Repository {

	public function get_all_categories() {
		return CategoryQuery::create()
			->find();
	}

	public function get_all_products() {
		return ProductQuery::create()
			->find();	
	}

	public function get_products($searchstring = NULL) {
		return ProductQuery::create()
			->filterByTitle($searchstring)
			->find();
	}

	public function get_products_by_category($category_id, $searchstring = NULL) {
		$category = CategoryQuery::create()
			->findPk($category_id);

		if (isset($searchstring)) {
			return ProductQuery::create()
				->filterByTitle($searchstring)
				->filterByCategory($category)
				->find();
		} else {
			return ProductQuery::create()
				->filterByCategory($category)
				->find();
		}
	}
	
	public function get_product_count_by_category($category_id) {
		$category = CategoryQuery::create()
			->findPk($category_id);

		return ProductQuery::create()
			->filterByCategory($category)
			->count();
	}
}
?>
