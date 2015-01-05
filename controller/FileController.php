<?php

/*
 * Get information to a product
 */
class FileController extends Controller {

	public function __construct() {
		parent::__construct();
		$this->vars->saveGlobal('id', SaveVars::T_NUMERIC, SaveVars::G_GET);
	}

	public function index() {
		$this->get();
	}
	
	public function get() {
		$user = Session::getInstance()->getUser();
		if (!isset($user)) {
			throw new Exception('user not allowed');
		}
		
		$code = CodeQuery::create()->findPk($this->vars->id);
		if (!isset($code)) {
			throw new Exception('file doesn\'t exist');
		}
		$offer = $code->getOffer();
		if (!isset($offer)) {
			throw new Exception('no offer to code file');
		}
		
		$numOrders = OrderQuery::create()
			->filterByUser($user)
			->filterByOffer($offer)
			->count();
		if ($numOrders == 0) {
			// user has not bought this file
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
