<?php

/*
 * Abstract class for MVC controllers.
 */
class MainController extends Controller {

	public function __construct() {
		parent::__construct();

		// set global data for view
		$data['title'] = $this->lang->title;
		$data['subtitle'] = $this->lang->subtitle;
		$data['author'] = $this->config['author'];
		$data['contact'] = $this->config['mail'];
		$data['metadata'] = array(
			'key1' => 'value1',
			'key2' => 'value2'
		);
		
		$data['locale'] = $this->lang->getLocale();
		
		$this->addData($data);
	}
}

?>