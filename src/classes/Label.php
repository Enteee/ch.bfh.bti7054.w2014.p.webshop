<?php

/*  
 * label.php
 * Winku
 * Version: 1.0
 */
class Label {

	private $lang;
	
	public function __construct($lang) {
		if (!isset($lang)) {
			throw new Exception('lang object is null.');
		}
		$this->lang = $lang;
	}

	public function __get($key) {
		return $this->lang->$key;
	}
}

?>
