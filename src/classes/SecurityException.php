<?php

/**
 * Can be trown to prevent access to an unauthorized user.
 */
class SecurityException extends Exception {

	public function __construct() {
		$message = 'user is unauthorized.';
		$code = 0;
		parent::__construct($message, $code);
	}
}

?>