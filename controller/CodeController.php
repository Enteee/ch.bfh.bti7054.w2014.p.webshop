<?php

/*
 * Get information to a product
 */
class CodeController extends Controller {

	public function __construct() {
		parent::__construct();
	}

	public function index() {
		$this->get(0);
	}
	
	public function download($codeId) {
		$codeId = intval($codeId);
		if ($codeId <= 0) {
			throw new NotFoundException('invalid id');
		}
		
		$user = Session::getInstance()->getUser();
		if (!isset($user)) {
			throw new Exception('user not allowed');
		}
		
		$code = CodeQuery::create()->findPk($codeId);
		if (!isset($code)) {
			throw new NotFoundException('file doesn\'t exist');
		}
		$offer = $code->getOffer();
		if (!isset($offer)) {
			throw new Exception('no offer to code file');
		}
		
		if (!$offer->userOwns()) {
			// user has not bought this file or has not uploaded it
			throw new Exception('user not allowed');
		}
		
		// download...
		header('Content-length: ' . $code->getFilesize());
		header('Content-type: ' . $code->getMimetype());
		header('Content-Disposition: attachment; filename=' . $code->getFilename());
		echo stream_get_contents($code->getContent());
	}
}

?>
