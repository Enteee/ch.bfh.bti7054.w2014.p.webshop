<?php



/**
 * This class defines the structure of the 'cs_product' table.
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
class ProductTableMap extends TableMap
{

    /**
     * The (dot-path) name of this class
     */
    const CLASS_NAME = 'model.map.ProductTableMap';

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
        $this->setName('cs_product');
        $this->setPhpName('Product');
        $this->setClassname('Product');
        $this->setPackage('model');
        $this->setUseIdGenerator(true);
        // columns
        $this->addPrimaryKey('id', 'Id', 'INTEGER', true, null, null);
        $this->addColumn('active', 'Active', 'BOOLEAN', true, 1, true);
        $this->addColumn('created_at', 'CreatedAt', 'TIMESTAMP', false, null, null);
        $this->addColumn('updated_at', 'UpdatedAt', 'TIMESTAMP', false, null, null);
        $this->addColumn('avg_rating', 'AvgRating', 'INTEGER', false, null, null);
        // validators
    } // initialize()

    /**
     * Build the RelationMap objects for this table relationships
     */
    public function buildRelations()
    {
        $this->addRelation('Review', 'Review', RelationMap::ONE_TO_MANY, array('id' => 'product_id', ), 'RESTRICT', 'RESTRICT', 'Reviews');
        $this->addRelation('Offer', 'Offer', RelationMap::ONE_TO_MANY, array('id' => 'product_id', ), 'RESTRICT', 'RESTRICT', 'Offers');
        $this->addRelation('ProductTag', 'ProductTag', RelationMap::ONE_TO_MANY, array('id' => 'product_id', ), 'RESTRICT', 'RESTRICT', 'ProductTags');
        $this->addRelation('ProductI18n', 'ProductI18n', RelationMap::ONE_TO_MANY, array('id' => 'id', ), 'CASCADE', null, 'ProductI18ns');
        $this->addRelation('Tag', 'Tag', RelationMap::MANY_TO_MANY, array(), 'RESTRICT', 'RESTRICT', 'Tags');
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
            'aggregate_column' =>  array (
  'name' => 'avg_rating',
  'expression' => 'AVG(rating)',
  'condition' => NULL,
  'foreign_table' => 'review',
  'foreign_schema' => NULL,
),
            'i18n' =>  array (
  'i18n_table' => '%TABLE%_i18n',
  'i18n_phpname' => '%PHPNAME%I18n',
  'i18n_columns' => 'name, description',
  'i18n_pk_name' => NULL,
  'locale_column' => 'locale',
  'default_locale' => NULL,
  'locale_alias' => '',
),
        );
    } // getBehaviors()

} // ProductTableMap
