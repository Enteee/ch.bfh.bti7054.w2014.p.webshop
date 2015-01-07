<?php



/**
 * Skeleton subclass for representing a row from the 'product' table.
 *
 *
 *
 * You should add additional methods to this class to meet the
 * application requirements.  This class will only be generated as
 * long as it does not already exist in the output directory.
 *
 * @package    propel.generator.model
 */
class Product extends BaseProduct implements JsonSerializable
{
	public function jsonSerialize(){
		return [
			'name' => $this->getName(),
			'tags' => $this->getTags(),
			'categories' => $this->getCategories(),
			'description' => $this->getDescription(),
			'programmingLanguage' => $this->getProgrammingLanguages(),
			'offers' => $this->getOffersByProduct(),
			'reviewsCount' => $this->countReviews(),
			'reviews' => $this->getReviews(),
			'avgRating' => $this->getAvgRating(),
		];
	}

	public function getCategories(){
		return TagQuery::create()
			->filterByProduct($this)
			->filterByActive(TRUE)
			->filterByTagType(TagType::getCategoryTagType())
			->find();
	}

	public function getProgrammingLanguages() {
		$repo = new Repository();
		return $repo->getProgrammingLanguagesByProduct($this);
	}
	
	public function getOffersByProduct() {
		$repo = new Repository();
		return $repo->getOffersByProduct($this);
	}
	
	public function getStartingFromPrice() {
		$cheapest = OfferQuery::create()
			->filterByProduct($this)
			->filterByActive(TRUE)
			->orderByPrice()
			->findOne();
		if (isset($cheapest)) {
			return $cheapest->getPrice();
		}
		return 0;
	}
	
	public function getWikiExtract() {
		try {
			// load wiki informations
			$wiki = NULL;
			$url = sprintf('http://en.wikipedia.org/w/api.php?format=json&action=query&titles=%s&prop=extracts&explaintext=1', urlencode($this->getName()));
			$content = file_get_contents($url);
			if (isset($content)) {
				$obj = json_decode($content, TRUE);
				if (isset($obj)) {
					if (count($obj['query']['pages']) > 0) {
						// take first page
						$page = reset($obj['query']['pages']);
						if (isset($page['extract'])) {
							$extract = $page['extract'];
							if (isset($extract)) {
								$maxlen = 500;
								if (strlen($extract) > $maxlen) {
									$extract = trim(substr($extract, 0, $maxlen)) . '...';
								}
								return $extract;
							}
						}
					}
				}
			}
		} catch (Exception $e) {
			// ignore
		}
		return NULL;
	}
}
