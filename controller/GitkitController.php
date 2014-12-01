<?php

class GitkitController extends Controller {

	public function __construct() {
		parent::__construct();
	}

	public function index() {
		// render template
		$this->view('gitkit', NULL);
	}
}

?>
