<?php

/*
 * Abstract class for MVC controllers.
 */
class ErrorController extends MainController {

	public function __construct() {
		parent::__construct();
	}
	
	public function index() {
		parent::main();
		$this->error404();
	}

	public function error404() {
		parent::main();
		
		$errorNr = '404';
		
		// set data for view
		$data['errorTitle'] = $this->lang->errorTitle . ' ' . $errorNr;
		$data['errorDescription'] = $this->lang->error404;
		
		// render template
		$this->view('error', $data);
	}
	
	public function error403() {
		parent::main();
		
		$errorNr = '403';
		
		// set data for view
		$data['errorTitle'] = $this->lang->errorTitle . ' ' . $errorNr;
		$data['errorDescription'] = $this->lang->error403;
		
		// render template
		$this->view('error', $data);
	}
	
	public function error500($exception) {
		parent::main();
		
		$errorNr = '500';
		$errorDesc = $this->lang->error500;
		
		$errorCode = NULL;
		if ($this->isDebug()) {
			// show exception if error reporting on
			$errorCode = $exception;
		}
		
		// set data for view
		$data['errorTitle'] = $this->lang->errorTitle . ' ' . $errorNr;
		$data['errorDescription'] = $errorDesc;
		$data['errorCode'] = $errorCode;
		
		// render template
		$this->view('error', $data);
	}
}

?>
