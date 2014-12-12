<?php
/*	template.php
*	Mischa Lehmann
*	ducksource@duckpond.ch
*	Version:1.0
*
*	Template class for proper html / php separation
*	Require:
*
*	Licence:
*	You're allowed to edit and publish my source in all of your free and open-source projects.
*	Please send me an e-mail if you'll implement this source in one of your commercial or proprietary projects.
*	Leave this Header untouched!
*
*	Warranty:
*		Warranty void if signet is broken
*	================== / /===================
*	[    Waranty      / /    Signet         ]
*	=================/ /=====================
*	!!Wo0t!!
*/
class Template {

	const DEFAULT_VIEW = 'start';

	private $view;
	private $data;

	public function __construct() {
		$this->view = self::DEFAULT_VIEW;
		$this->data = array();
	}
	
	public function setView($view) {
		if (isset($view)) {
			$this->view = $view;
		} else {
			// default view
			$this->view = self::DEFAULT_VIEW;
		}
	}
	
	private function getTemplatePath() {
		return '../view/' . $this->view . '.php';
	}
	
	public function addData($data) {
		if (isset($data)) {
			$this->data = array_merge($this->data, $data);
		}
	}
	
	/*
	 * Convert a string to html format
	 */
	private function stringToHtml($string) {
		return htmlentities($string, ENT_QUOTES);
	}

	/*
	 * Return a given variable for display
	 */
	public function getValue($key) {
		// get variable
		$value = null;
		if (array_key_exists($key, $this->data)){
			$value = $this->data[$key];
		}	
		// if this is a string convert to string to html format
		if (is_string($value)){ 
			$value = $this->stringToHtml($value);
		}
		return $value;
	}

	/*
	 * Include a view.
	 */
	public function view($name = NULL, $data = NULL) {
		$this->setView($name);		
		$this->addData($data);
		$this->render();
	}
	
	/*
	 * Render the template.
	 */
	private function render() {
		// make variables available local
		foreach (array_keys($this->data) as $key) {
			${$key} = $this->getValue($key);
		}	
		// include template
		include $this->getTemplatePath();
	}
}
?>
