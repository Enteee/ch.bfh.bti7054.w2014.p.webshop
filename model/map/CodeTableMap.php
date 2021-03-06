<?php



/**
 * This class defines the structure of the 'cs_code' table.
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
class CodeTableMap extends TableMap
{

    /**
     * The (dot-path) name of this class
     */
    const CLASS_NAME = 'model.map.CodeTableMap';

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
        $this->setName('cs_code');
        $this->setPhpName('Code');
        $this->setClassname('Code');
        $this->setPackage('model');
        $this->setUseIdGenerator(true);
        // columns
        $this->addPrimaryKey('id', 'Id', 'INTEGER', true, null, null);
        $this->addForeignKey('user_id', 'UserId', 'INTEGER', 'cs_user', 'id', true, null, null);
        $this->addForeignKey('offer_id', 'OfferId', 'INTEGER', 'cs_offer', 'id', true, null, null);
        $this->addColumn('filename', 'Filename', 'VARCHAR', true, 200, null);
        $this->addColumn('filesize', 'Filesize', 'INTEGER', true, null, 0);
        $this->addColumn('mimetype', 'Mimetype', 'VARCHAR', true, 200, null);
        $this->addColumn('content', 'Content', 'BLOB', true, null, null);
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
        $this->addRelation('User', 'User', RelationMap::MANY_TO_ONE, array('user_id' => 'id', ), 'RESTRICT', 'RESTRICT');
        $this->addRelation('Offer', 'Offer', RelationMap::MANY_TO_ONE, array('offer_id' => 'id', ), 'RESTRICT', 'RESTRICT');
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
        );
    } // getBehaviors()

} // CodeTableMap
