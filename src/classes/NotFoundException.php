<?php

/**
 * Can be trown to force the framework to show an 404 error.
 */
class NotFoundException extends Exception {

	public function __construct() {
		parent::__construct('Requested content was not found');
	}

}

?>