<?php



/**
 * This class defines the structure of the 'cs_product_i18n' table.
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
class ProductI18nTableMap extends TableMap
{

    /**
     * The (dot-path) name of this class
     */
    const CLASS_NAME = 'model.map.ProductI18nTableMap';

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
        $this->setName('cs_product_i18n');
        $this->setPhpName('ProductI18n');
        $this->setClassname('ProductI18n');
        $this->setPackage('model');
        $this->setUseIdGenerator(false);
        // columns
        $this->addForeignPrimaryKey('id', 'Id', 'INTEGER' , 'cs_product', 'id', true, null, null);
        $this->addPrimaryKey('locale', 'Locale', 'VARCHAR', true, 5, 'en_US');
        $this->addColumn('name', 'Name', 'VARCHAR', true, 200, null);
        $this->addColumn('description', 'Description', 'VARCHAR', true, 1000, null);
        // validators
    } // initialize()

    /**
     * Build the RelationMap objects for this table relationships
     */
    public function buildRelations()
    {
        $this->addRelation('Product', 'Product', RelationMap::MANY_TO_ONE, array('id' => 'id', ), 'CASCADE', null);
    } // buildRelations()

} // ProductI18nTableMap
