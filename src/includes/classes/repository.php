<?php

class Repository {
	
	public static function get_all_categories() {
		$list = array();
		
		$category = new Category();
		$category.set_name('sinep');		
		$list[] = $category;

		$category = new Category();
		$category.set_name('sinep2');		
		$list[] = $category;
		
		return $list;
	}
	
	public static function get_products($searchstring = NULL) {
		$list = array();
		
		$product = new Product();
		$product.set_name('sinep');		
		$list[] = $product;

		$product = new Product();
		$product.set_name('sinep2');		
		$list[] = $product;
		
		return $list;
	}
	
	public static function get_products_by_category($category_id, $searchstring = NULL) {
		$list = array();
		
		$product = new Product();
		$product.set_name('sinep');		
		$list[] = $product;

		$product = new Product();
		$product.set_name('sinep2');		
		$list[] = $product;
		
		return $list;
	}
}

?>
