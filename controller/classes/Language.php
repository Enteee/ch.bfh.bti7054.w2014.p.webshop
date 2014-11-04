<?php

/*  
 * language.php
 * Winku
 * Version: 1.0
 */
class Language {

	const DE = 0;
	const EN = 1;
	const LANG_FILE = '../resource/lang/lang.json';
	const LABEL_NOT_FOUND_FALLBACK = '';
	private $valid_languages = array('DE', 'EN');	
	private $language;
	private $data;

	public function __construct($language) {	
		// set language
		$language = strtoupper($language);
		if (!$this->is_language_valid($language)) {
			throw new Exception('Language '. $language . ' not supported');
		}
		$this->language = $language;
		
		// load data
		$json = file_get_contents(self::LANG_FILE);
		$this->data = $this->json_clean_decode($json);
	}
	
	private function is_language_valid($language) {
		return in_array($language, $this->valid_languages, TRUE);
	}
	
	/*
	 * Realizes parsing of json files including comments.
	 * Source: http://php.net/manual/de/function.json-decode.php#112735
	 */
	private function json_clean_decode($json, $assoc = false, $depth = 512, $options = 0) {
		// search and remove comments like /* */ and //
		$json = preg_replace("#(/\*([^*]|[\r\n]|(\*+([^*/]|[\r\n])))*\*+/)|([\s\t]//.*)|(^//.*)#", '', $json);

		if(version_compare(phpversion(), '5.4.0', '>=')) {
			$json = json_decode($json, $assoc, $depth, $options);
		}
		elseif(version_compare(phpversion(), '5.3.0', '>=')) {
			$json = json_decode($json, $assoc, $depth);
		}
		else {
			$json = json_decode($json, $assoc);
		}

		return $json;
	}

	public function __get($label) {
		$value = $this->get_label_by_language($label, $this->language);
		if (isset($value)) {
			return $value;
		} else {
			// use a fallback
			foreach ($this->valid_languages as $valid_language) {
				$value = $this->get_label_by_language($label, $valid_language);
				if (isset($value)) {
					return $value;
				}
			}
		}
		return self::LABEL_NOT_FOUND_FALLBACK; // label not found
	}
	
	public function get_label_by_language($label, $language) {
		if (isset($this->data->$label)) {
			$labelObj = $this->data->$label;
			if (isset($labelObj->$language)) {
				return $labelObj->$language;
			}
		}
		return NULL; // label not found
	}
}

?>
