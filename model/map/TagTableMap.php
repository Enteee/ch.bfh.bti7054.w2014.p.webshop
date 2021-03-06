<?php



/**
 * This class defines the structure of the 'cs_tag' table.
 *
 *
 *
 * This map class is used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 *
 * @package    propel.generator.model.map
 */
class TagTableMap extends TableMap
{

    /**
     * The (dot-path) name of this class
     */
    const CLASS_NAME = 'model.map.TagTableMap';

    /**
     * Initialize the table attributes, columns and validators
     * Relations are not initialized by this method since they are lazy loaded
     *
     * @return void
     * @throws PropelException
     */
    public function initialize()
    {
        // attributes
        $this->setName('cs_tag');
        $this->setPhpName('Tag');
        $this->setClassname('Tag');
        $this->setPackage('model');
        $this->setUseIdGenerator(true);
        // columns
        $this->addPrimaryKey('id', 'Id', 'INTEGER', true, null, null);
        $this->addForeignKey('type_id', 'TypeId', 'INTEGER', 'cs_tag_type', 'id', true, null, null);
        $this->addForeignKey('parent_id', 'ParentId', 'INTEGER', 'cs_tag', 'id', false, null, null);
        $this->addColumn('active', 'Active', 'BOOLEAN', true, 1, true);
        $this->addColumn('created_at', 'CreatedAt', 'TIMESTAMP', false, null, null);
        $this->addColumn('updated_at', 'UpdatedAt', 'TIMESTAMP', false, null, null);
        // validators
    } // initialize()

    /**
     * Build the RelationMap objects for this table relationships
     */
    public function buildRelations()
    {
        $this->addRelation('TagRelatedByParentId', 'Tag', RelationMap::MANY_TO_ONE, array('parent_id' => 'id', ), 'RESTRICT', 'RESTRICT');
        $this->addRelation('TagType', 'TagType', RelationMap::MANY_TO_ONE, array('type_id' => 'id', ), 'RESTRICT', 'RESTRICT');
        $this->addRelation('OfferTag', 'OfferTag', RelationMap::ONE_TO_MANY, array('id' => 'tag_id', ), 'RESTRICT', 'RESTRICT', 'OfferTags');
        $this->addRelation('ProductTag', 'ProductTag', RelationMap::ONE_TO_MANY, array('id' => 'tag_id', ), 'RESTRICT', 'RESTRICT', 'ProductTags');
        $this->addRelation('TagRelatedById', 'Tag', RelationMap::ONE_TO_MANY, array('id' => 'parent_id', ), 'RESTRICT', 'RESTRICT', 'TagsRelatedById');
        $this->addRelation('TagI18n', 'TagI18n', RelationMap::ONE_TO_MANY, array('id' => 'id', ), 'CASCADE', null, 'TagI18ns');
        $this->addRelation('Offer', 'Offer', RelationMap::MANY_TO_MANY, array(), 'RESTRICT', 'RESTRICT', 'Offers');
        $this->addRelation('Product', 'Product', RelationMap::MANY_TO_MANY, array(), 'RESTRICT', 'RESTRICT', 'Products');
    } // buildRelations()

    /**
     *
     * Gets the list of behaviors registered for this table
     *
     * @return array Associative array (name => parameters) of behaviors
     */
    public function getBehaviors()
    {
        return array(
            'timestampable' =>  array (
  'create_column' => 'created_at',
  'update_column' => 'updated_at',
  'disable_updated_at' => 'false',
),
            'i18n' =>  array (
  'i18n_table' => '%TABLE%_i18n',
  'i18n_phpname' => '%PHPNAME%I18n',
  'i18n_columns' => 'name',
  'i18n_pk_name' => NULL,
  'locale_column' => 'locale',
  'default_locale' => NULL,
  'locale_alias' => '',
),
        );
    } // getBehaviors()

} // TagTableMap
