<?php

/*
 * Abstract class for MVC controllers.
 */
class MainController extends Controller {

	protected $categoryId;	

	public function __construct() {
		parent::__construct();
		
		// save variables
		$this->vars->save_global('category',SaveVars::T_INT,SaveVars::G_GET);
				
		// get variables
		$this->categoryId = $this->vars->category;
		
		// load data
		$categories = $this->repo->getAllCategories();
		
		// set global data for view
		$data['title'] = $this->lang->title;
		$data['subtitle'] = $this->lang->subtitle;
		$data['author'] = $this->config['author'];
		$data['contact'] = $this->config['mail'];
		$data['metadata'] = array(
			'keywords' => 'codeshop,code,shop,snippets,buy'
		);
		
		$data['locale'] = $this->lang->getLocale();
		
		$data['categories'] = $categories;
		$data['activeCategoryId'] = $this->categoryId;
		
		$this->addData($data);
	}
}

?>