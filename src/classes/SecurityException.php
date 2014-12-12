<?php

/**
 * Can be trown to prevent access to an unauthorized user.
 */
class SecurityException extends Exception {

	public function __construct() {
		parent::__construct('User is not authorized to access this content');
	}

}

?>