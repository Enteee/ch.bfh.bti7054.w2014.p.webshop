<?php

class Repository {

	public function getAllCategories() {
		$tagType = TagTypeQuery::create()->findPk(Tag::CATEGORY);
		return TagQuery::create()
			->filterByTagType($tagType)
			->find();
	}
	
	public function getCategoriesBySearch($searchstring = NULL) {		
		if (isset($searchstring)) {
			$tagType = TagTypeQuery::create()->findPk(Tag::CATEGORY);
			return TagQuery::create()
				->filterByTagType($tagType)
				->useTagI18nQuery()
					->filterByName('%' . $searchstring . '%')
				->endUse()
				->find();
		} else {
			return $this->getAllCategories();
		}
	}
	
	public function getAllProgrammingLanguages() {
		$tagType = TagTypeQuery::create()->findPk(Tag::PROGRAMMING_LANGUAGE);
		return TagQuery::create()
			->filterByTagType($tagType)
			->find();
	}
	
	public function getProgrammingLanguagesBySearch($searchstring = NULL) {		
		if (isset($searchstring)) {
			$tagType = TagTypeQuery::create()->findPk(Tag::PROGRAMMING_LANGUAGE);
			return TagQuery::create()
				->filterByTagType($tagType)
				->useTagI18nQuery()
					->filterByName('%' . $searchstring . '%')
				->endUse()
				->find();
		} else {
			return $this->getAllProgrammingLanguages();
		}
	}
	
	public function getAllProducts() {
		return ProductQuery::create()
			->find();
	}
	
	

	public function getProductById($product_id) {
		return ProductQuery::create()
			->findPk($product_id);
	}

	public function getProductsBySearch($searchstring = NULL) {
		if (isset($searchstring)) {
			return ProductQuery::create()
				->useProductI18nQuery()
					->filterByName('%' . $searchstring . '%')
				->endUse()
				->groupBy('id')
				->find();
		} else {
			return $this->getAllProducts();
		}
	}

	public function getProductsByTagId($tag_id, $searchstring = NULL) {
		if (isset($searchstring)) {
			return ProductQuery::create()
				->useProductI18nQuery()
					->filterByName('%'. $searchstring. '%')
				->endUse()
				->useProductTagQuery()
					->filterByTagId($tag_id)
				->endUse()
				->groupBy('id')
				->find();
		} else {
			return ProductQuery::create()
				->useProductTagQuery()
					->filterByTagId($tag_id)
				->endUse()
				->groupBy('id')
				->find();
		}
	}
	
	public function getUsersOrders($tag_id = NULL, $searchstring = NULL, $user = NULL) {
		$query = ProductQuery::create();
		
		if (isset($tag_id)) {
			$query
				->useProductTagQuery()
					->filterByTagId($tag_id)
				->endUse();
		}
		if (isset($searchstring)) {
			$query
				->useProductI18nQuery()
					->filterByName('%' . $searchstring . '%')
				->endUse();
		}		
		if (isset($user)) {
			$query
				->useOfferQuery()
					->useOrderQuery()
						->filterByUser($user)					
					->endUse()
				->endUse();
		}		
		return $query->find();
	}
	
	public function getUsersOffers($tag_id = NULL, $searchstring = NULL, $user = NULL) {
		$query = ProductQuery::create();
		
		if (isset($tag_id)) {
			$query
				->useProductTagQuery()
					->filterByTagId($tag_id)
				->endUse();
		}
		if (isset($searchstring)) {
			$query
				->useProductI18nQuery()
					->filterByName('%' . $searchstring . '%')
				->endUse();
		}		
		if (isset($user)) {
			$query
				->useOfferQuery()
					->useCodeQuery()
						->filterByUser($user)					
					->endUse()
				->endUse();
		}		
		return $query->find();
	}
	
	public function getProductCountByTag($tag) {
		return ProductTagQuery::create()
			->filterByTag($tag)
			->count();
	}
	
	public function getTagsByProduct($product) {
		return TagQuery::create()
			->useProductTagQuery()
				->filterByProduct($product)
			->endUse()
			->find();
	}
	
	public function getProgrammingLanguagesByProduct($product) {
		$tagType = TagTypeQuery::create()->findPk(Tag::PROGRAMMING_LANGUAGE);
		return TagQuery::create()
			->useProductTagQuery()
				->filterByProduct($product)
			->endUse()
			->filterByTagType($tagType)
			->find();
	}
	
	public function getVersionsByProduct($product) {
		return CodeQuery::create()
			->useOfferQuery()
				->filterByProduct($product)
			->endUse()
			->find();
	}

	public function getReviewById($review_id) {
		return ReviewQuery::create()
			->findPk($review_id);
	}
	
	public function getReviewsByProduct($product) {
		if (isset($product)) {
			return ReviewQuery::create()
				->filterByProduct($product)
				->find();
		} else {
			return array();
		}
	}

	public function getUserByToken($token) {
		$users = UserQuery::create()
			->filterByToken($token)
			->find();
		if (count($users) > 1) {
			throw new Exception('multiple users with same token');
		}
		if (count($users) == 1) {
			return $users[0];
		}
		return NULL;
	}
}
?>
