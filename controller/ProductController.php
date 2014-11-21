<?php

/*
 * Get information to a product
 */
class ProductController extends MainController {

	public function __construct() {
		parent::__construct();
		$this->vars->save_global('product_id', SaveVars::T_INT, SaveVars::G_POST);
		$this->vars->save_global('product_name', SaveVars::T_STRING, SaveVars::G_POST);
		$this->vars->save_global('product_description', SaveVars::T_STRING, SaveVars::G_POST);
		$this->vars->save_global('product_categories', SaveVars::T_STRING, SaveVars::G_POST);
		$this->vars->save_global('product_programminglanguages', SaveVars::T_STRING, SaveVars::G_POST);
		$this->vars->save_global('product_price', SaveVars::T_INT, SaveVars::G_POST);
		$this->vars->save_global('product_file', SaveVars::T_ARRAY, SaveVars::G_FILES);
	}

	public function index() {
	}
	
	public function add() {
		$data = array();
		
		$this->getUser();
	
		// render template
		$this->view('add_product', $data);
	}
	
	public function save() {
	
		// validate...
		$file = $this->vars->product_file;		
		if (!isset($file)) {
			throw new Exception('no file uploaded');
		}		
		if (!is_uploaded_file($file['tmp_name'])) {
			throw new Exception('no file uploaded');
		}
		if ($file['error'] != UPLOAD_ERR_OK) {
			$message = 'Error uploading file';
			switch($file['error']) {
				case UPLOAD_ERR_INI_SIZE:
				case UPLOAD_ERR_FORM_SIZE:
					throw new Exception('file too large');
				case UPLOAD_ERR_PARTIAL:
					throw new Exception('file upload was not completed.');
				case UPLOAD_ERR_NO_FILE:
					throw new Exception('zero-length file uploaded');
				default:
					throw new Exception('internal error');
			}
		}
		
		// TODO: validate all!
	
		$user = $this->getUser();
	
		// load product if exists
		$product = ProductQuery::create()->findPk($this->vars->product_id);
		if (!isset($product)) {
			// create product, it doesn't already exist
			$product = new Product();
			foreach ($this->lang->getAllLocales() as $locale) {
				$product->setLocale($locale);			
				$product->setName($this->vars->product_name);
				$product->setDescription($this->vars->product_description);
			}
			$product->setActive(true);
			
			$product->save();
		}
		
		$offer = new Offer();
		$offer->setProduct($product);
		$offer->setPrice($this->vars->product_price);
		$offer->setActive(true);
		
		$offer->save();
		
		$code = new Code();
		$code->setUser($user);
		$code->setOffer($offer);
		$code->setFilename($file['name']);
		$code->setFilesize($file['size']);
		$code->setMimetype($file['type']);
		$code->setContent(file_get_contents($file['tmp_name']));
		$code->setActive(true);
		
		$code->save();
	}
}

?>
