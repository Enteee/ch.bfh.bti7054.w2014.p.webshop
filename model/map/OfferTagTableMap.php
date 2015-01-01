<?php



/**
 * This class defines the structure of the 'cs_offer_tag' table.
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
class OfferTagTableMap extends TableMap
{

    /**
     * The (dot-path) name of this class
     */
    const CLASS_NAME = 'model.map.OfferTagTableMap';

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
        $this->setName('cs_offer_tag');
        $this->setPhpName('OfferTag');
        $this->setClassname('OfferTag');
        $this->setPackage('model');
        $this->setUseIdGenerator(true);
        $this->setIsCrossRef(true);
        // columns
        $this->addPrimaryKey('id', 'Id', 'INTEGER', true, null, null);
        $this->addForeignKey('offer_id', 'OfferId', 'INTEGER', 'cs_offer', 'id', true, null, null);
        $this->addForeignKey('tag_id', 'TagId', 'INTEGER', 'cs_tag', 'id', true, null, null);
        // validators
    } // initialize()

    /**
     * Build the RelationMap objects for this table relationships
     */
    public function buildRelations()
    {
        $this->addRelation('Offer', 'Offer', RelationMap::MANY_TO_ONE, array('offer_id' => 'id', ), 'RESTRICT', 'RESTRICT');
        $this->addRelation('Tag', 'Tag', RelationMap::MANY_TO_ONE, array('tag_id' => 'id', ), 'RESTRICT', 'RESTRICT');
    } // buildRelations()

} // OfferTagTableMap
