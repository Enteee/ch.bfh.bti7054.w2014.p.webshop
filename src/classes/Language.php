<?php

/*  
 * language.php
 * Winku
 * Version: 2.0
 */
class Language {

	const LANG_FILE = '../resource/lang/lang.json';
	const LABEL_NOT_FOUND_FALLBACK = '';
	
	/*
	 * Valid locales that matches with the locales in the database.
	 */
	private $validLocales = array(	
		'en' => array('US'),
		'de' => array('CH')
	);
	
	/*
	 * ISO 639-1 Codes for the representation of names of languages 
	 * http://en.wikipedia.org/wiki/ISO_639-1
	 */
	const VALID_LANGUAGE_REGEX = '~^(aa|ab|ae|af|ak|am|an|ar|as|av|ay|az|ba|be|bg|bh|bi|bm|bn|bo|br|bs|ca|ca|ce|ch|co|cr|cs|cu|cu|cu|cu|cu|cv|cy|da|de|dv|dv|dv|dz|ee|el|en|eo|es|es|et|eu|fa|ff|fi|fj|fo|fr|fy|ga|gd|gd|gl|gn|gu|gv|ha|he|hi|ho|hr|ht|ht|hu|hy|hz|ia|id|ie|ie|ig|ii|ii|ik|io|is|it|iu|ja|jv|ka|kg|ki|ki|kj|kj|kk|kl|kl|km|kn|ko|kr|ks|ku|kv|kw|ky|ky|la|lb|lb|lg|li|li|li|ln|lo|lt|lu|lv|mg|mh|mi|mk|ml|mn|mr|ms|mt|my|na|nb|nb|nd|nd|ne|ng|nl|nl|nn|nn|no|nr|nr|nv|nv|ny|ny|ny|oc|oj|om|or|os|os|pa|pa|pi|pl|ps|ps|pt|qu|rm|rn|ro|ro|ro|ru|rw|sa|sc|sd|se|sg|si|si|sk|sl|sm|sn|so|sq|sr|ss|st|su|sv|sw|ta|te|tg|th|ti|tk|tl|tn|to|tr|ts|tt|tw|ty|ug|ug|uk|ur|uz|ve|vi|vo|wa|wo|xh|yi|yo|za|za|zh|zu)$~';
	private $language;
	
	/*
	 * ISO 3166-1 Codes for the representation of names of countries and their subdivisions
	 * http://en.wikipedia.org/wiki/ISO_3166-1
	 */	 
	const VALID_COUNTRY_REGEX = '~^(AF|AX|AL|DZ|AS|AD|AO|AI|AQ|AG|AR|AM|AW|AU|AT|AZ|BS|BH|BD|BB|BY|BE|BZ|BJ|BM|BT|BO|BQ|BA|BW|BV|BR|IO|BN|BG|BF|BI|KH|CM|CA|CV|KY|CF|TD|CL|CN|CX|CC|CO|KM|CG|CD|CK|CR|CI|HR|CU|CW|CY|CZ|DK|DJ|DM|DO|EC|EG|SV|GQ|ER|EE|ET|FK|FO|FJ|FI|FR|GF|PF|TF|GA|GM|GE|DE|GH|GI|GR|GL|GD|GP|GU|GT|GG|GN|GW|GY|HT|HM|VA|HN|HK|HU|IS|IN|ID|IR|IQ|IE|IM|IL|IT|JM|JP|JE|JO|KZ|KE|KI|KP|KR|KW|KG|LA|LV|LB|LS|LR|LY|LI|LT|LU|MO|MK|MG|MW|MY|MV|ML|MT|MH|MQ|MR|MU|YT|MX|FM|MD|MC|MN|ME|MS|MA|MZ|MM|NA|NR|NP|NL|NC|NZ|NI|NE|NG|NU|NF|MP|NO|OM|PK|PW|PS|PA|PG|PY|PE|PH|PN|PL|PT|PR|QA|RE|RO|RU|RW|BL|SH|KN|LC|MF|PM|VC|WS|SM|ST|SA|SN|RS|SC|SL|SG|SX|SK|SI|SB|SO|ZA|GS|SS|ES|LK|SD|SR|SJ|SZ|SE|CH|SY|TW|TJ|TZ|TH|TL|TG|TK|TO|TT|TN|TR|TM|TC|TV|UG|UA|AE|GB|US|UM|UY|UZ|VU|VE|VN|VG|VI|WF|EH|YE|ZM|ZW)$~';
	private $country;
	
	const CLIENT_LANGUAGE_REGEX = '~^([a-zA-Z]{2})([_-])([a-zA-Z]{2})~';
	
	private $data;
	
	public function __construct() {
	}
	
	public function init() {
		// load data
		$json = file_get_contents(self::LANG_FILE);
		$this->data = $this->jsonCleanDecode($json);
	}
	
	public function parseClientLanguage($clientLanguage) {
		if (isset($clientLanguage) && strlen($clientLanguage) >= 5 && preg_match(self::CLIENT_LANGUAGE_REGEX, $clientLanguage)) {
			// locale found
			$language = strtolower(substr($clientLanguage, 0, 2));
			$country = strtoupper(substr($clientLanguage, 3, 2));
			$this->setLocale($language, $country);
		} else {
			// use fallback
			$this->setLocale(NULL, NULL);
		}
	}
	
	/*
	 * Realizes parsing of json files including comments.
	 * Source: http://php.net/manual/de/function.json-decode.php#112735
	 */
	private function jsonCleanDecode($json, $assoc = false, $depth = 512, $options = 0) {
		// search and remove comments like /* */ and //
		$json = preg_replace("#(/\*([^*]|[\r\n]|(\*+([^*/]|[\r\n])))*\*+/)|([\s\t]//.*)|(^//.*)#", '', $json);
		if (version_compare(phpversion(), '5.4.0', '>=')) {
			$json = json_decode($json, $assoc, $depth, $options);
		} elseif(version_compare(phpversion(), '5.3.0', '>=')) {
			$json = json_decode($json, $assoc, $depth);
		} else {
			$json = json_decode($json, $assoc);
		}
		return $json;
	}
	
	private function getLanguageFallback() {
		if (count($this->validLocales) == 0) {
			throw new Exception('No locales defined.');
		}
		$validLocales = reset($this->validLocales);
		// return first key (= language) in array
		reset($validLocales);
		return key($validLocales);
	}
	
	private function getFallbackCountry() {
		if (count($this->validLocales) == 0) {
			throw new Exception('No locales defined.');
		}
		$validLocales = $this->validLocales[$this->language];
		if (count($validLocales) == 0) {
			throw new Exception('No contries defined for the language.');
		}		
		// return first element (= country) in array
		return $validLocales[0];
	}
	
	public function setLocale($language, $country) {
		// valid language?
		if (isset($language) && self::isLanguageValid($language) && array_key_exists($language, $this->validLocales)) {
			// language okay
			$this->language = $language;
			$validLocales = $this->validLocales[$language];
			// valid country?
			if (isset($country) && self::isCountryValid($country) && in_array($country, $validLocales)) {
				// valid country
				$this->country = $country;
			} else {
				// use fallback
				$this->country = $this->getFallbackCountry();
			}
		} else {
			// use fallback
			$this->language = $this->getLanguageFallback();
			$this->country = $this->getFallbackCountry();
		}
	}
	
	private function formatLocale($language, $country) {
		return sprintf('%s_%s', $language, $country);
	}
	
	public function getLocale() {
		return sprintf('%s_%s', $this->language, $this->country);			
	}	
	
	public static function isLanguageValid($language) {
		return isset($language) && preg_match(self::VALID_LANGUAGE_REGEX, $language);
	}
	
	public function getLanguage() {
		return $this->language;
	}
	
	public static function isCountryValid($country) {
		return isset($country) && preg_match(self::VALID_COUNTRY_REGEX, $country);
	}
	
	public function getCountry() {
		return $this->country;
	}

	public function getLabel($label, $key) {
		if (isset($this->data->$label)) {
			$labelObj = $this->data->$label;
			if (isset($labelObj->$key)) {
				return $labelObj->$key;
			}
		}
		return NULL; // label not found
	}
	
	public function __get($label) {
		// try find by locale	
		$value = $this->getLabel($label, $this->getLocale());
		if (isset($value)) {
			return $value;
		}
		// try find only by language
		$value = $this->getLabel($label, $this->getLanguage());
		if (isset($value)) {
			return $value;
		}
		// use fallback
		$value = $this->getLabel($label, $this->getLanguageFallback());
		if (isset($value)) {
			return $value;
		}
		return self::LABEL_NOT_FOUND_FALLBACK; // label not found
	}
}

?>
