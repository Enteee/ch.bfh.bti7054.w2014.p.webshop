<?php

class Repository {

    private $all_products   = array();        //List of all Products
    private $all_categories = array();      //List of all Categories

    function __construct($inc){
        /* Load data classes */
        $inc->dorequire('product.php');
        $inc->dorequire('category.php');

        /* Create Data */
        /* Categories */
        $category = new Category();
        $category->set_name('Snippets');
        $this->all_categories[] = $category;

        $category = new Category();
        $category->set_name('Scripts');
        $this->all_categories[] = $category;

        $category = new Category();
        $category->set_name('Full software');
        $this->all_categories[] = $category;

        $category = new Category();
        $category->set_name('Classes');
        $this->all_categories[] = $category;

        $category = new Category();
        $category->set_name('Frameworks');
        $this->all_categories[] = $category;

        /* Products */
        $product = new Product();
        $product->set_name('Hello world');
        $product->set_categories(array($this->all_categories[0]));
        $product->set_description('The famous hello world snippets');
        $product->set_tags(array('Tag1','Tag2','Tag3','Tag4'));
        $product->set_languages(array('C','C++','PHP','Javascript'));
        $product->set_versions(array('0.1','0.2','1.0','2.0'));
        $this->all_products[] = $product;

        $product = new Product();
        $product->set_name('Bubble sort');
        $product->set_categories(array($this->all_categories[0]));
        $product->set_description('Basic sort method');
        $product->set_tags(array('Tag3','Tag4'));
        $product->set_languages(array('PHP','Javascript'));
        $product->set_versions(array('Alpha','Beta','1.0','2.0'));
        $this->all_products[] = $product;

        $product = new Product();
        $product->set_name('Quick sort');
        $product->set_categories(array($this->all_categories[2]));
        $product->set_description('Basic sort method');
        $product->set_tags(array('Tag4'));
        $product->set_languages(array('C','C++'));
        $product->set_versions(array('1.0'));
        $this->all_products[] = $product;
    }

    public function get_all_categories() {
        return $this->all_categories;
    }

    public function get_products($searchstring = NULL) {
        $products_found = array();

        if(isset($searchstring)){
            foreach ($this->all_products as $product){
                $search_space = $product->get_name().$product->get_description();
                if( strstr ($search_space, $searchstring) != false){
                    $products_found[] = $product;
                }
            }
        }else{
            $products_found = $this->all_products;
        }
        return $products_found;
    }

    public function get_products_by_category($search_category, $searchstring = NULL) {
        $products_found = array();
        $products_cat_matched = array();

        foreach ($this->all_products as $product){
            foreach($product->get_categories as $category){
                if($category->get_name() == $search_category->get_name()){
                    $products_cat_matched[] = $product;
                }
            }
        }

        if (isset($searchstring)){
            foreach ($products_cat_matched as $product){
                $search_space = $product->get_name().$product->get_description();
                if( strstr ($search_space, $searchstring) != false){
                    $products_found[] = $product;
                }
            }
        }else{
            $products_found = $products_cat_matched;
        }

        return $products_found;
    }
}
?>
