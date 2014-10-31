<?php

class Repository {

    function __construct($inc){
        /* Load data classes */
        $inc->dorequire('Product.php');
		  $inc->dorequire('BaseProduct.php');
		  $inc->dorequire('ProductQuery.php');		  
        $inc->dorequire('Category.php');
		  $inc->dorequire('BaseCategory.php');
		  $inc->dorequire('CategoryQuery.php');
    }

    public function get_all_categories() {
			return CategoryQuery::create()
				->find();
    }

    public function get_products($searchstring = NULL) {
			return ProductQuery::create()
				->filterByTitle($searchstring)
				->find();
    }

    public function get_products_by_category($search_category, $searchstring = NULL) {
			$category = CategoryQuery::create()->findPk($search_category);
			return ProductQuery::create()
				->filterByTitle($searchstring)
				->filterByCategory($category)
				->find();
    }
}
?>
