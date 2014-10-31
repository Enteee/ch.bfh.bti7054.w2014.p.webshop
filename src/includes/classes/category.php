<?php

class Category {

    private $name               = '';
    private $products_count     = 0;

    public function get_name() {
        return $this->name;
    }

    public function set_name($name) {
        $this->name = $name;
    }

    public function get_products_count() {
        return $this->products_count;
    }

    public function set_products_count($products_count) {
        $this->products_count = $products_count;
    }
}

?>
