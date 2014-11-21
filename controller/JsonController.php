<?php

/*
 * Get information as json
 */
class JsonController extends MainController {

	public function __construct() {
		parent::__construct();
		$this->vars->save_global('type',SaveVars::T_STRING,SaveVars::G_GET);
		$this->vars->save_global('id',SaveVars::T_INT,SaveVars::G_GET);
	}

	public function index() {
		$object = null;
		switch($this->vars->type){
			case "product":
				$object = $this->repo->getProductById($this->vars->id);
				if(isset($object)){
					$object->setLocale($this->lang->getLocale());
				}
			break;
			case "review":
				$object = $this->repo->getReviewById($this->vars->id);
			break;
			default:
				// do nothing
		}
		$data = [
			'json' => $object,
		];
		// render template
		$this->view('json', $data);
	}	
}

?>
