<?php

/*
 * Abstract class for MVC controllers.
 */
class ErrorController extends MainController {

	public function __construct() {
		parent::__construct();
	}
	
	public function index() {
		$this->error404();
	}

	public function error404() {	
		
		$errorNr = '404';
		
		// set data for view
		$data['errorTitle'] = $this->lang->errorTitle . ' ' . $errorNr;
		$data['errorDescription'] = $this->lang->error404;
		
		// render template
		$this->view('error', $data);
	}	
}

?>