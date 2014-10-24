<?php

class Repository {

	$all_products = array();		//List of all Products
	$all_categories = array();		//List of all Categories

    function __construct($inc){
        /* Load data classes */
        $inc->dorequire('product.php');
        $inc->dorequire('category.php');
		
		
		/* Create Data */
		
		/* Categories */
		$category = new Category();
        $category->set_name('Snippets');
        $all_categories[] = $category;

        $category = new Category();
        $category->set_name('Scripts');       
        $all_categories[] = $category;
		
		$category = new Category();
        $category->set_name('Full software');       
        $all_categories[] = $category;
		
		$category = new Category();
        $category->set_name('Classes');       
        $all_categories[] = $category;
		
		$category = new Category();
        $category->set_name('Frameworks');       
        $all_categories[] = $category;
		
		/* Products */
		$product = new Product();
        $product->set_name('Hello world');
		$product->set_categories('Snippets');
		$product->set_description('The famous hello world snippets');		
        $all_categories = $product;
		
		$product = new Product();
        $product->set_name('Bubble sort'); 
		$product->set_categories('Methods');
		$product->set_description('Basic sort method');
        $all_categories = $product;

        $product = new Product();
        $product->set_name('Quick sort');
		$product->set_categories('Methods');
		$product->set_description('Basic sort method');		
        $all_categories = $product;
		
		
    }
    
    public function get_all_categories() {
        return $all_categories;
    }
    
    public function get_products($searchstring = NULL) {
        $products_found = array();
		
		foreach ($all_products as $key => $value){
			if( strstr ($value->get_name().$value->get_description(), $searchstring) != false){
			$products_found = $value;
			}
		}
        return $products_found;
    }
    
    public function get_products_by_category($category_id, $searchstring = NULL) {
        $products_found = array();
        $products_cat_matched = array();
		
		foreach ($all_products as $key => $value){
			if( strstr ($value->get_categories, $category_id) != false){
			$products_cat_matched = $value;
			}
		}
		
		if ($searchstring != NULL){
			foreach ($all_products as $key => $value){
				if( strstr ($value->get_name().$value->get_description(), $searchstring) != false){
				$products_cat_matched = $value;
				}
			}
		}else{
		$products_found = $products_cat_matched;
		}
        
        return $products_found;
    }
}
?>
