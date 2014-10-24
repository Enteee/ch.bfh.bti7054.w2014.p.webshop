<?php

class Product {

	private $name;
	private $description;
	private $categories;
	
	public function get_name() {
		return $this->name;
	}
	
	public function set_name($name) {
		$this->name = $name;
	}
	
	public function get_description() {
		return $this->description;
	}
	
	public function set_description($description) {
		$this->description = $description;
	}
	
	public function get_categories() {
		return $this->categories;
	}
	
	public function set_categories($categories) {
		$this->categories = $categories;
	}
}

?>
