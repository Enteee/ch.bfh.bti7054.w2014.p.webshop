<?php

/*
 * Abstract class for MVC controllers.
 */
class ErrorController extends MainController {

	public function __construct() {
		parent::__construct();
	}
	
	public function index() {
		parent::index();
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
	
	public function error403() {	
		
		$errorNr = '403';
		
		// set data for view
		$data['errorTitle'] = $this->lang->errorTitle . ' ' . $errorNr;
		$data['errorDescription'] = $this->lang->error403;
		
		// render template
		$this->view('error', $data);
	}
	
	public function error500($exception) {	
		
		$errorNr = '500';
		$errorDesc = $this->lang->error500;
		
		if ($this->isDebug()) {
			// show exception if error reporting on
			$errorDesc = $exception;
		}
		
		// set data for view
		$data['errorTitle'] = $this->lang->errorTitle . ' ' . $errorNr;
		$data['errorDescription'] = $errorDesc;
		
		// render template
		$this->view('error', $data);
	}	
}

?>
