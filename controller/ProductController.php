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
		if (!$this->isLoggedIn()) {
			// TODO: use own exception and handle in mvc framework
			throw new Exception('forbidden');
		}

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
		
		$con = Propel::getConnection();
		$con->beginTransaction();
		try {
			// load product if exists
			$product = ProductQuery::create()->findPk($this->vars->product_id);
			if (!isset($product)) {
				// create product, it doesn't already exist
				$product = new Product();
				foreach ($this->lang->getAllLocales() as $locale) {
					$product
						->setLocale($locale)		
							->setName($this->vars->product_name)
							->setDescription($this->vars->product_description);
				}
				$product->setActive(true);
				
				$product->save();
			}
			
			// categories
			$categoryIds = $this->splitInts($this->vars->product_categories);
			if (count($categoryIds) > 0) {
				foreach ($categoryIds as $categoryId) {
					$category = TagQuery::create()->getCategory($categoryId);
					if (isset($category)) {
						$product->addTag($category);
					}
				}
				$product->save();
			}
			
			// offer
			$offer = new Offer();						
			$offer
				->setProduct($product)
				->setPrice($this->vars->product_price)
				->setActive(true)
				->save();
			
			// programming languages
			$plIds = $this->splitInts($this->vars->product_programminglanguages);
			if (count($plIds) > 0) {
				foreach ($plIds as $plId) {
					$pl = TagQuery::create()->getProgrammingLanguage($plId);
					if (isset($pl)) {
						$offer->addTag($pl);
					}
				}
				$offer->save();
			}
			
			// code
			$code = new Code();
			$code
				->setUser($user)
				->setOffer($offer)
				->setFilename($file['name'])
				->setFilesize($file['size'])
				->setMimetype($file['type'])
				->setContent(file_get_contents($file['tmp_name']))
				->setActive(true)		
				->save();

			$con->commit();
		} catch (Exception $e) {
			$con->rollback();
			throw $e;
		}
	}
	
	private function splitInts($input) {
		$ids = array();
		$parts = preg_split('`,`', $input);
		foreach ($parts as $part) {
			$id = filter_var($part, FILTER_VALIDATE_INT);
			if ($id) { $ids[] = $id; }
		}
		return $ids;
	}
}

?>
