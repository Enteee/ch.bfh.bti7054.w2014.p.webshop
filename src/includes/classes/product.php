<?php

class Product {

    private $name           = '';
    private $description    = '';
    private $categories     = NULL;
    private $tags           = array();
    private $options        = array();
    private $languages      = array();
    private $versions       = array();
    
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

    public function get_tags() {
        return $this->tags;
    }
    
    public function set_tags($tags) {
        $this->tags = $tags;
    }

    public function get_languages() {
        return $this->languages;
    }

    public function set_languages($languages) {
        $this->languages = $languages;
    }

    public function get_versions() {
        return $this->versions;
    }

    public function set_versions($versions) {
        $this->versions = $versions;
    }

}

?>
