<?php



/**
 * Skeleton subclass for performing query and update operations on the 'tag' table.
 *
 *
 *
 * You should add additional methods to this class to meet the
 * application requirements.  This class will only be generated as
 * long as it does not already exist in the output directory.
 *
 * @package    propel.generator.model
 */
class TagQuery extends BaseTagQuery
{
	public function getUserTag($id) {
		return $this
			->filterById($id)
			->useTagTypeQuery()
				->filterById(Tag::USER_TAG)
			->endUse()
			->findOne();
	}

	public function getCategory($id) {
		return $this
			->filterById($id)
			->useTagTypeQuery()
				->filterById(Tag::CATEGORY)
			->endUse()
			->findOne();
	}

	public function getProgrammingLanguage($id) {
		return $this
			->filterById($id)
			->useTagTypeQuery()
				->filterById(Tag::PROGRAMMING_LANGUAGE)
			->endUse()
			->findOne();
	}	
}
