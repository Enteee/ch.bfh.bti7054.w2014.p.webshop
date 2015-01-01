<?php



/**
 * Skeleton subclass for representing a row from the 'tag_type' table.
 *
 *
 *
 * You should add additional methods to this class to meet the
 * application requirements.  This class will only be generated as
 * long as it does not already exist in the output directory.
 *
 * @package    propel.generator.model
 */
class TagType extends BaseTagType
{
	/* Special types */
	const USER_TAG_TYPE_ID = 1;
	private static $USER_TAG_TYPE;
	const CATEGORY_TAG_TYPE_ID = 2;
	private static $CATEGORY_TAG_TYPE;
	const PROGRAMMING_LANGUAGE_TYPE_ID = 3;
	private static $PROGRAMMING_LANGUAGE_TAG_TYPE;

	public static function getUserTagType(){
		if(!isset(self::$USER_TAG_TYPE)){
				self::$USER_TAG_TYPE = TagTypeQuery::create()->findPk(self::USER_TAG_TYPE_ID);
		}
		return self::$USER_TAG_TYPE;
	}

	public static function getCategoryTagType(){
		if(!isset(self::$CATEGORY_TAG_TYPE)){
				self::$CATEGORY_TAG_TYPE = TagTypeQuery::create()->findPk(self::CATEGORY_TAG_TYPE_ID);
		}
		return self::$CATEGORY_TAG_TYPE;
	}

	public static function getProgrammingLanguageTagType(){
		if(!isset(self::$PROGRAMMING_LANGUAGE_TAG_TYPE)){
				self::$PROGRAMMING_LANGUAGE_TAG_TYPE = TagTypeQuery::create()->findPk(self::PROGRAMMING_LANGUAGE_TAG_TYPE_ID);
		}
		return self::$PROGRAMMING_LANGUAGE_TAG_TYPE;
	}

}
