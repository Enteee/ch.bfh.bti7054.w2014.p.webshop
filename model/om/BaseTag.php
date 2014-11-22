<?php


/**
 * Base class that represents a row from the 'tag' table.
 *
 *
 *
 * @package    propel.generator.model.om
 */
abstract class BaseTag extends BaseObject implements Persistent
{
    /**
     * Peer class name
     */
    const PEER = 'TagPeer';

    /**
     * The Peer class.
     * Instance provides a convenient way of calling static methods on a class
     * that calling code may not be able to identify.
     * @var        TagPeer
     */
    protected static $peer;

    /**
     * The flag var to prevent infinite loop in deep copy
     * @var       boolean
     */
    protected $startCopy = false;

    /**
     * The value for the id field.
     * @var        int
     */
    protected $id;

    /**
     * The value for the type_id field.
     * @var        int
     */
    protected $type_id;

    /**
     * The value for the parent_id field.
     * @var        int
     */
    protected $parent_id;

    /**
     * The value for the active field.
     * Note: this column has a database default value of: true
     * @var        boolean
     */
    protected $active;

    /**
     * The value for the created_at field.
     * @var        string
     */
    protected $created_at;

    /**
     * The value for the updated_at field.
     * @var        string
     */
    protected $updated_at;

    /**
     * @var        Tag
     */
    protected $aTagRelatedByParentId;

    /**
     * @var        TagType
     */
    protected $aTagType;

    /**
     * @var        PropelObjectCollection|OfferTag[] Collection to store aggregation of OfferTag objects.
     */
    protected $collOfferTags;
    protected $collOfferTagsPartial;

    /**
     * @var        PropelObjectCollection|ProductTag[] Collection to store aggregation of ProductTag objects.
     */
    protected $collProductTags;
    protected $collProductTagsPartial;

    /**
     * @var        PropelObjectCollection|Tag[] Collection to store aggregation of Tag objects.
     */
    protected $collTagsRelatedById;
    protected $collTagsRelatedByIdPartial;

    /**
     * @var        PropelObjectCollection|TagI18n[] Collection to store aggregation of TagI18n objects.
     */
    protected $collTagI18ns;
    protected $collTagI18nsPartial;

    /**
     * @var        PropelObjectCollection|Offer[] Collection to store aggregation of Offer objects.
     */
    protected $collOffers;

    /**
     * @var        PropelObjectCollection|Product[] Collection to store aggregation of Product objects.
     */
    protected $collProducts;

    /**
     * Flag to prevent endless save loop, if this object is referenced
     * by another object which falls in this transaction.
     * @var        boolean
     */
    protected $alreadyInSave = false;

    /**
     * Flag to prevent endless validation loop, if this object is referenced
     * by another object which falls in this transaction.
     * @var        boolean
     */
    protected $alreadyInValidation = false;

    /**
     * Flag to prevent endless clearAllReferences($deep=true) loop, if this object is referenced
     * @var        boolean
     */
    protected $alreadyInClearAllReferencesDeep = false;

    // i18n behavior

    /**
     * Current locale
     * @var        string
     */
    protected $currentLocale = 'en_US';

    /**
     * Current translation objects
     * @var        array[TagI18n]
     */
    protected $currentTranslations;

    /**
     * An array of objects scheduled for deletion.
     * @var		PropelObjectCollection
     */
    protected $offersScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var		PropelObjectCollection
     */
    protected $productsScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var		PropelObjectCollection
     */
    protected $offerTagsScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var		PropelObjectCollection
     */
    protected $productTagsScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var		PropelObjectCollection
     */
    protected $tagsRelatedByIdScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var		PropelObjectCollection
     */
    protected $tagI18nsScheduledForDeletion = null;

    /**
     * Applies default values to this object.
     * This method should be called from the object's constructor (or
     * equivalent initialization method).
     * @see        __construct()
     */
    public function applyDefaultValues()
    {
        $this->active = true;
    }

    /**
     * Initializes internal state of BaseTag object.
     * @see        applyDefaults()
     */
    public function __construct()
    {
        parent::__construct();
        $this->applyDefaultValues();
    }

    /**
     * Get the [id] column value.
     *
     * @return int
     */
    public function getId()
    {

        return $this->id;
    }

    /**
     * Get the [type_id] column value.
     *
     * @return int
     */
    public function getTypeId()
    {

        return $this->type_id;
    }

    /**
     * Get the [parent_id] column value.
     *
     * @return int
     */
    public function getParentId()
    {

        return $this->parent_id;
    }

    /**
     * Get the [active] column value.
     *
     * @return boolean
     */
    public function getActive()
    {

        return $this->active;
    }

    /**
     * Get the [optionally formatted] temporal [created_at] column value.
     *
     *
     * @param string $format The date/time format string (either date()-style or strftime()-style).
     *				 If format is null, then the raw DateTime object will be returned.
     * @return mixed Formatted date/time value as string or DateTime object (if format is null), null if column is null, and 0 if column value is 0000-00-00 00:00:00
     * @throws PropelException - if unable to parse/validate the date/time value.
     */
    public function getCreatedAt($format = 'Y-m-d H:i:s')
    {
        if ($this->created_at === null) {
            return null;
        }

        if ($this->created_at === '0000-00-00 00:00:00') {
            // while technically this is not a default value of null,
            // this seems to be closest in meaning.
            return null;
        }

        try {
            $dt = new DateTime($this->created_at);
        } catch (Exception $x) {
            throw new PropelException("Internally stored date/time/timestamp value could not be converted to DateTime: " . var_export($this->created_at, true), $x);
        }

        if ($format === null) {
            // Because propel.useDateTimeClass is true, we return a DateTime object.
            return $dt;
        }

        if (strpos($format, '%') !== false) {
            return strftime($format, $dt->format('U'));
        }

        return $dt->format($format);

    }

    /**
     * Get the [optionally formatted] temporal [updated_at] column value.
     *
     *
     * @param string $format The date/time format string (either date()-style or strftime()-style).
     *				 If format is null, then the raw DateTime object will be returned.
     * @return mixed Formatted date/time value as string or DateTime object (if format is null), null if column is null, and 0 if column value is 0000-00-00 00:00:00
     * @throws PropelException - if unable to parse/validate the date/time value.
     */
    public function getUpdatedAt($format = 'Y-m-d H:i:s')
    {
        if ($this->updated_at === null) {
            return null;
        }

        if ($this->updated_at === '0000-00-00 00:00:00') {
            // while technically this is not a default value of null,
            // this seems to be closest in meaning.
            return null;
        }

        try {
            $dt = new DateTime($this->updated_at);
        } catch (Exception $x) {
            throw new PropelException("Internally stored date/time/timestamp value could not be converted to DateTime: " . var_export($this->updated_at, true), $x);
        }

        if ($format === null) {
            // Because propel.useDateTimeClass is true, we return a DateTime object.
            return $dt;
        }

        if (strpos($format, '%') !== false) {
            return strftime($format, $dt->format('U'));
        }

        return $dt->format($format);

    }

    /**
     * Set the value of [id] column.
     *
     * @param  int $v new value
     * @return Tag The current object (for fluent API support)
     */
    public function setId($v)
    {
        if ($v !== null && is_numeric($v)) {
            $v = (int) $v;
        }

        if ($this->id !== $v) {
            $this->id = $v;
            $this->modifiedColumns[] = TagPeer::ID;
        }


        return $this;
    } // setId()

    /**
     * Set the value of [type_id] column.
     *
     * @param  int $v new value
     * @return Tag The current object (for fluent API support)
     */
    public function setTypeId($v)
    {
        if ($v !== null && is_numeric($v)) {
            $v = (int) $v;
        }

        if ($this->type_id !== $v) {
            $this->type_id = $v;
            $this->modifiedColumns[] = TagPeer::TYPE_ID;
        }

        if ($this->aTagType !== null && $this->aTagType->getId() !== $v) {
            $this->aTagType = null;
        }


        return $this;
    } // setTypeId()

    /**
     * Set the value of [parent_id] column.
     *
     * @param  int $v new value
     * @return Tag The current object (for fluent API support)
     */
    public function setParentId($v)
    {
        if ($v !== null && is_numeric($v)) {
            $v = (int) $v;
        }

        if ($this->parent_id !== $v) {
            $this->parent_id = $v;
            $this->modifiedColumns[] = TagPeer::PARENT_ID;
        }

        if ($this->aTagRelatedByParentId !== null && $this->aTagRelatedByParentId->getId() !== $v) {
            $this->aTagRelatedByParentId = null;
        }


        return $this;
    } // setParentId()

    /**
     * Sets the value of the [active] column.
     * Non-boolean arguments are converted using the following rules:
     *   * 1, '1', 'true',  'on',  and 'yes' are converted to boolean true
     *   * 0, '0', 'false', 'off', and 'no'  are converted to boolean false
     * Check on string values is case insensitive (so 'FaLsE' is seen as 'false').
     *
     * @param boolean|integer|string $v The new value
     * @return Tag The current object (for fluent API support)
     */
    public function setActive($v)
    {
        if ($v !== null) {
            if (is_string($v)) {
                $v = in_array(strtolower($v), array('false', 'off', '-', 'no', 'n', '0', '')) ? false : true;
            } else {
                $v = (boolean) $v;
            }
        }

        if ($this->active !== $v) {
            $this->active = $v;
            $this->modifiedColumns[] = TagPeer::ACTIVE;
        }


        return $this;
    } // setActive()

    /**
     * Sets the value of [created_at] column to a normalized version of the date/time value specified.
     *
     * @param mixed $v string, integer (timestamp), or DateTime value.
     *               Empty strings are treated as null.
     * @return Tag The current object (for fluent API support)
     */
    public function setCreatedAt($v)
    {
        $dt = PropelDateTime::newInstance($v, null, 'DateTime');
        if ($this->created_at !== null || $dt !== null) {
            $currentDateAsString = ($this->created_at !== null && $tmpDt = new DateTime($this->created_at)) ? $tmpDt->format('Y-m-d H:i:s') : null;
            $newDateAsString = $dt ? $dt->format('Y-m-d H:i:s') : null;
            if ($currentDateAsString !== $newDateAsString) {
                $this->created_at = $newDateAsString;
                $this->modifiedColumns[] = TagPeer::CREATED_AT;
            }
        } // if either are not null


        return $this;
    } // setCreatedAt()

    /**
     * Sets the value of [updated_at] column to a normalized version of the date/time value specified.
     *
     * @param mixed $v string, integer (timestamp), or DateTime value.
     *               Empty strings are treated as null.
     * @return Tag The current object (for fluent API support)
     */
    public function setUpdatedAt($v)
    {
        $dt = PropelDateTime::newInstance($v, null, 'DateTime');
        if ($this->updated_at !== null || $dt !== null) {
            $currentDateAsString = ($this->updated_at !== null && $tmpDt = new DateTime($this->updated_at)) ? $tmpDt->format('Y-m-d H:i:s') : null;
            $newDateAsString = $dt ? $dt->format('Y-m-d H:i:s') : null;
            if ($currentDateAsString !== $newDateAsString) {
                $this->updated_at = $newDateAsString;
                $this->modifiedColumns[] = TagPeer::UPDATED_AT;
            }
        } // if either are not null


        return $this;
    } // setUpdatedAt()

    /**
     * Indicates whether the columns in this object are only set to default values.
     *
     * This method can be used in conjunction with isModified() to indicate whether an object is both
     * modified _and_ has some values set which are non-default.
     *
     * @return boolean Whether the columns in this object are only been set with default values.
     */
    public function hasOnlyDefaultValues()
    {
            if ($this->active !== true) {
                return false;
            }

        // otherwise, everything was equal, so return true
        return true;
    } // hasOnlyDefaultValues()

    /**
     * Hydrates (populates) the object variables with values from the database resultset.
     *
     * An offset (0-based "start column") is specified so that objects can be hydrated
     * with a subset of the columns in the resultset rows.  This is needed, for example,
     * for results of JOIN queries where the resultset row includes columns from two or
     * more tables.
     *
     * @param array $row The row returned by PDOStatement->fetch(PDO::FETCH_NUM)
     * @param int $startcol 0-based offset column which indicates which resultset column to start with.
     * @param boolean $rehydrate Whether this object is being re-hydrated from the database.
     * @return int             next starting column
     * @throws PropelException - Any caught Exception will be rewrapped as a PropelException.
     */
    public function hydrate($row, $startcol = 0, $rehydrate = false)
    {
        try {

            $this->id = ($row[$startcol + 0] !== null) ? (int) $row[$startcol + 0] : null;
            $this->type_id = ($row[$startcol + 1] !== null) ? (int) $row[$startcol + 1] : null;
            $this->parent_id = ($row[$startcol + 2] !== null) ? (int) $row[$startcol + 2] : null;
            $this->active = ($row[$startcol + 3] !== null) ? (boolean) $row[$startcol + 3] : null;
            $this->created_at = ($row[$startcol + 4] !== null) ? (string) $row[$startcol + 4] : null;
            $this->updated_at = ($row[$startcol + 5] !== null) ? (string) $row[$startcol + 5] : null;
            $this->resetModified();

            $this->setNew(false);

            if ($rehydrate) {
                $this->ensureConsistency();
            }
            $this->postHydrate($row, $startcol, $rehydrate);

            return $startcol + 6; // 6 = TagPeer::NUM_HYDRATE_COLUMNS.

        } catch (Exception $e) {
            throw new PropelException("Error populating Tag object", $e);
        }
    }

    /**
     * Checks and repairs the internal consistency of the object.
     *
     * This method is executed after an already-instantiated object is re-hydrated
     * from the database.  It exists to check any foreign keys to make sure that
     * the objects related to the current object are correct based on foreign key.
     *
     * You can override this method in the stub class, but you should always invoke
     * the base method from the overridden method (i.e. parent::ensureConsistency()),
     * in case your model changes.
     *
     * @throws PropelException
     */
    public function ensureConsistency()
    {

        if ($this->aTagType !== null && $this->type_id !== $this->aTagType->getId()) {
            $this->aTagType = null;
        }
        if ($this->aTagRelatedByParentId !== null && $this->parent_id !== $this->aTagRelatedByParentId->getId()) {
            $this->aTagRelatedByParentId = null;
        }
    } // ensureConsistency

    /**
     * Reloads this object from datastore based on primary key and (optionally) resets all associated objects.
     *
     * This will only work if the object has been saved and has a valid primary key set.
     *
     * @param boolean $deep (optional) Whether to also de-associated any related objects.
     * @param PropelPDO $con (optional) The PropelPDO connection to use.
     * @return void
     * @throws PropelException - if this object is deleted, unsaved or doesn't have pk match in db
     */
    public function reload($deep = false, PropelPDO $con = null)
    {
        if ($this->isDeleted()) {
            throw new PropelException("Cannot reload a deleted object.");
        }

        if ($this->isNew()) {
            throw new PropelException("Cannot reload an unsaved object.");
        }

        if ($con === null) {
            $con = Propel::getConnection(TagPeer::DATABASE_NAME, Propel::CONNECTION_READ);
        }

        // We don't need to alter the object instance pool; we're just modifying this instance
        // already in the pool.

        $stmt = TagPeer::doSelectStmt($this->buildPkeyCriteria(), $con);
        $row = $stmt->fetch(PDO::FETCH_NUM);
        $stmt->closeCursor();
        if (!$row) {
            throw new PropelException('Cannot find matching row in the database to reload object values.');
        }
        $this->hydrate($row, 0, true); // rehydrate

        if ($deep) {  // also de-associate any related objects?

            $this->aTagRelatedByParentId = null;
            $this->aTagType = null;
            $this->collOfferTags = null;

            $this->collProductTags = null;

            $this->collTagsRelatedById = null;

            $this->collTagI18ns = null;

            $this->collOffers = null;
            $this->collProducts = null;
        } // if (deep)
    }

    /**
     * Removes this object from datastore and sets delete attribute.
     *
     * @param PropelPDO $con
     * @return void
     * @throws PropelException
     * @throws Exception
     * @see        BaseObject::setDeleted()
     * @see        BaseObject::isDeleted()
     */
    public function delete(PropelPDO $con = null)
    {
        if ($this->isDeleted()) {
            throw new PropelException("This object has already been deleted.");
        }

        if ($con === null) {
            $con = Propel::getConnection(TagPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
        }

        $con->beginTransaction();
        try {
            $deleteQuery = TagQuery::create()
                ->filterByPrimaryKey($this->getPrimaryKey());
            $ret = $this->preDelete($con);
            if ($ret) {
                $deleteQuery->delete($con);
                $this->postDelete($con);
                $con->commit();
                $this->setDeleted(true);
            } else {
                $con->commit();
            }
        } catch (Exception $e) {
            $con->rollBack();
            throw $e;
        }
    }

    /**
     * Persists this object to the database.
     *
     * If the object is new, it inserts it; otherwise an update is performed.
     * All modified related objects will also be persisted in the doSave()
     * method.  This method wraps all precipitate database operations in a
     * single transaction.
     *
     * @param PropelPDO $con
     * @return int             The number of rows affected by this insert/update and any referring fk objects' save() operations.
     * @throws PropelException
     * @throws Exception
     * @see        doSave()
     */
    public function save(PropelPDO $con = null)
    {
        if ($this->isDeleted()) {
            throw new PropelException("You cannot save an object that has been deleted.");
        }

        if ($con === null) {
            $con = Propel::getConnection(TagPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
        }

        $con->beginTransaction();
        $isInsert = $this->isNew();
        try {
            $ret = $this->preSave($con);
            if ($isInsert) {
                $ret = $ret && $this->preInsert($con);
                // timestampable behavior
                if (!$this->isColumnModified(TagPeer::CREATED_AT)) {
                    $this->setCreatedAt(time());
                }
                if (!$this->isColumnModified(TagPeer::UPDATED_AT)) {
                    $this->setUpdatedAt(time());
                }
            } else {
                $ret = $ret && $this->preUpdate($con);
                // timestampable behavior
                if ($this->isModified() && !$this->isColumnModified(TagPeer::UPDATED_AT)) {
                    $this->setUpdatedAt(time());
                }
            }
            if ($ret) {
                $affectedRows = $this->doSave($con);
                if ($isInsert) {
                    $this->postInsert($con);
                } else {
                    $this->postUpdate($con);
                }
                $this->postSave($con);
                TagPeer::addInstanceToPool($this);
            } else {
                $affectedRows = 0;
            }
            $con->commit();

            return $affectedRows;
        } catch (Exception $e) {
            $con->rollBack();
            throw $e;
        }
    }

    /**
     * Performs the work of inserting or updating the row in the database.
     *
     * If the object is new, it inserts it; otherwise an update is performed.
     * All related objects are also updated in this method.
     *
     * @param PropelPDO $con
     * @return int             The number of rows affected by this insert/update and any referring fk objects' save() operations.
     * @throws PropelException
     * @see        save()
     */
    protected function doSave(PropelPDO $con)
    {
        $affectedRows = 0; // initialize var to track total num of affected rows
        if (!$this->alreadyInSave) {
            $this->alreadyInSave = true;

            // We call the save method on the following object(s) if they
            // were passed to this object by their corresponding set
            // method.  This object relates to these object(s) by a
            // foreign key reference.

            if ($this->aTagRelatedByParentId !== null) {
                if ($this->aTagRelatedByParentId->isModified() || $this->aTagRelatedByParentId->isNew()) {
                    $affectedRows += $this->aTagRelatedByParentId->save($con);
                }
                $this->setTagRelatedByParentId($this->aTagRelatedByParentId);
            }

            if ($this->aTagType !== null) {
                if ($this->aTagType->isModified() || $this->aTagType->isNew()) {
                    $affectedRows += $this->aTagType->save($con);
                }
                $this->setTagType($this->aTagType);
            }

            if ($this->isNew() || $this->isModified()) {
                // persist changes
                if ($this->isNew()) {
                    $this->doInsert($con);
                } else {
                    $this->doUpdate($con);
                }
                $affectedRows += 1;
                $this->resetModified();
            }

            if ($this->offersScheduledForDeletion !== null) {
                if (!$this->offersScheduledForDeletion->isEmpty()) {
                    $pks = array();
                    $pk = $this->getPrimaryKey();
                    foreach ($this->offersScheduledForDeletion->getPrimaryKeys(false) as $remotePk) {
                        $pks[] = array($remotePk, $pk);
                    }
                    OfferTagQuery::create()
                        ->filterByPrimaryKeys($pks)
                        ->delete($con);
                    $this->offersScheduledForDeletion = null;
                }

                foreach ($this->getOffers() as $offer) {
                    if ($offer->isModified()) {
                        $offer->save($con);
                    }
                }
            } elseif ($this->collOffers) {
                foreach ($this->collOffers as $offer) {
                    if ($offer->isModified()) {
                        $offer->save($con);
                    }
                }
            }

            if ($this->productsScheduledForDeletion !== null) {
                if (!$this->productsScheduledForDeletion->isEmpty()) {
                    $pks = array();
                    $pk = $this->getPrimaryKey();
                    foreach ($this->productsScheduledForDeletion->getPrimaryKeys(false) as $remotePk) {
                        $pks[] = array($remotePk, $pk);
                    }
                    ProductTagQuery::create()
                        ->filterByPrimaryKeys($pks)
                        ->delete($con);
                    $this->productsScheduledForDeletion = null;
                }

                foreach ($this->getProducts() as $product) {
                    if ($product->isModified()) {
                        $product->save($con);
                    }
                }
            } elseif ($this->collProducts) {
                foreach ($this->collProducts as $product) {
                    if ($product->isModified()) {
                        $product->save($con);
                    }
                }
            }

            if ($this->offerTagsScheduledForDeletion !== null) {
                if (!$this->offerTagsScheduledForDeletion->isEmpty()) {
                    OfferTagQuery::create()
                        ->filterByPrimaryKeys($this->offerTagsScheduledForDeletion->getPrimaryKeys(false))
                        ->delete($con);
                    $this->offerTagsScheduledForDeletion = null;
                }
            }

            if ($this->collOfferTags !== null) {
                foreach ($this->collOfferTags as $referrerFK) {
                    if (!$referrerFK->isDeleted() && ($referrerFK->isNew() || $referrerFK->isModified())) {
                        $affectedRows += $referrerFK->save($con);
                    }
                }
            }

            if ($this->productTagsScheduledForDeletion !== null) {
                if (!$this->productTagsScheduledForDeletion->isEmpty()) {
                    ProductTagQuery::create()
                        ->filterByPrimaryKeys($this->productTagsScheduledForDeletion->getPrimaryKeys(false))
                        ->delete($con);
                    $this->productTagsScheduledForDeletion = null;
                }
            }

            if ($this->collProductTags !== null) {
                foreach ($this->collProductTags as $referrerFK) {
                    if (!$referrerFK->isDeleted() && ($referrerFK->isNew() || $referrerFK->isModified())) {
                        $affectedRows += $referrerFK->save($con);
                    }
                }
            }

            if ($this->tagsRelatedByIdScheduledForDeletion !== null) {
                if (!$this->tagsRelatedByIdScheduledForDeletion->isEmpty()) {
                    foreach ($this->tagsRelatedByIdScheduledForDeletion as $tagRelatedById) {
                        // need to save related object because we set the relation to null
                        $tagRelatedById->save($con);
                    }
                    $this->tagsRelatedByIdScheduledForDeletion = null;
                }
            }

            if ($this->collTagsRelatedById !== null) {
                foreach ($this->collTagsRelatedById as $referrerFK) {
                    if (!$referrerFK->isDeleted() && ($referrerFK->isNew() || $referrerFK->isModified())) {
                        $affectedRows += $referrerFK->save($con);
                    }
                }
            }

            if ($this->tagI18nsScheduledForDeletion !== null) {
                if (!$this->tagI18nsScheduledForDeletion->isEmpty()) {
                    TagI18nQuery::create()
                        ->filterByPrimaryKeys($this->tagI18nsScheduledForDeletion->getPrimaryKeys(false))
                        ->delete($con);
                    $this->tagI18nsScheduledForDeletion = null;
                }
            }

            if ($this->collTagI18ns !== null) {
                foreach ($this->collTagI18ns as $referrerFK) {
                    if (!$referrerFK->isDeleted() && ($referrerFK->isNew() || $referrerFK->isModified())) {
                        $affectedRows += $referrerFK->save($con);
                    }
                }
            }

            $this->alreadyInSave = false;

        }

        return $affectedRows;
    } // doSave()

    /**
     * Insert the row in the database.
     *
     * @param PropelPDO $con
     *
     * @throws PropelException
     * @see        doSave()
     */
    protected function doInsert(PropelPDO $con)
    {
        $modifiedColumns = array();
        $index = 0;

        $this->modifiedColumns[] = TagPeer::ID;
        if (null !== $this->id) {
            throw new PropelException('Cannot insert a value for auto-increment primary key (' . TagPeer::ID . ')');
        }

         // check the columns in natural order for more readable SQL queries
        if ($this->isColumnModified(TagPeer::ID)) {
            $modifiedColumns[':p' . $index++]  = '`id`';
        }
        if ($this->isColumnModified(TagPeer::TYPE_ID)) {
            $modifiedColumns[':p' . $index++]  = '`type_id`';
        }
        if ($this->isColumnModified(TagPeer::PARENT_ID)) {
            $modifiedColumns[':p' . $index++]  = '`parent_id`';
        }
        if ($this->isColumnModified(TagPeer::ACTIVE)) {
            $modifiedColumns[':p' . $index++]  = '`active`';
        }
        if ($this->isColumnModified(TagPeer::CREATED_AT)) {
            $modifiedColumns[':p' . $index++]  = '`created_at`';
        }
        if ($this->isColumnModified(TagPeer::UPDATED_AT)) {
            $modifiedColumns[':p' . $index++]  = '`updated_at`';
        }

        $sql = sprintf(
            'INSERT INTO `tag` (%s) VALUES (%s)',
            implode(', ', $modifiedColumns),
            implode(', ', array_keys($modifiedColumns))
        );

        try {
            $stmt = $con->prepare($sql);
            foreach ($modifiedColumns as $identifier => $columnName) {
                switch ($columnName) {
                    case '`id`':
                        $stmt->bindValue($identifier, $this->id, PDO::PARAM_INT);
                        break;
                    case '`type_id`':
                        $stmt->bindValue($identifier, $this->type_id, PDO::PARAM_INT);
                        break;
                    case '`parent_id`':
                        $stmt->bindValue($identifier, $this->parent_id, PDO::PARAM_INT);
                        break;
                    case '`active`':
                        $stmt->bindValue($identifier, (int) $this->active, PDO::PARAM_INT);
                        break;
                    case '`created_at`':
                        $stmt->bindValue($identifier, $this->created_at, PDO::PARAM_STR);
                        break;
                    case '`updated_at`':
                        $stmt->bindValue($identifier, $this->updated_at, PDO::PARAM_STR);
                        break;
                }
            }
            $stmt->execute();
        } catch (Exception $e) {
            Propel::log($e->getMessage(), Propel::LOG_ERR);
            throw new PropelException(sprintf('Unable to execute INSERT statement [%s]', $sql), $e);
        }

        try {
            $pk = $con->lastInsertId();
        } catch (Exception $e) {
            throw new PropelException('Unable to get autoincrement id.', $e);
        }
        $this->setId($pk);

        $this->setNew(false);
    }

    /**
     * Update the row in the database.
     *
     * @param PropelPDO $con
     *
     * @see        doSave()
     */
    protected function doUpdate(PropelPDO $con)
    {
        $selectCriteria = $this->buildPkeyCriteria();
        $valuesCriteria = $this->buildCriteria();
        BasePeer::doUpdate($selectCriteria, $valuesCriteria, $con);
    }

    /**
     * Array of ValidationFailed objects.
     * @var        array ValidationFailed[]
     */
    protected $validationFailures = array();

    /**
     * Gets any ValidationFailed objects that resulted from last call to validate().
     *
     *
     * @return array ValidationFailed[]
     * @see        validate()
     */
    public function getValidationFailures()
    {
        return $this->validationFailures;
    }

    /**
     * Validates the objects modified field values and all objects related to this table.
     *
     * If $columns is either a column name or an array of column names
     * only those columns are validated.
     *
     * @param mixed $columns Column name or an array of column names.
     * @return boolean Whether all columns pass validation.
     * @see        doValidate()
     * @see        getValidationFailures()
     */
    public function validate($columns = null)
    {
        $res = $this->doValidate($columns);
        if ($res === true) {
            $this->validationFailures = array();

            return true;
        }

        $this->validationFailures = $res;

        return false;
    }

    /**
     * This function performs the validation work for complex object models.
     *
     * In addition to checking the current object, all related objects will
     * also be validated.  If all pass then <code>true</code> is returned; otherwise
     * an aggregated array of ValidationFailed objects will be returned.
     *
     * @param array $columns Array of column names to validate.
     * @return mixed <code>true</code> if all validations pass; array of <code>ValidationFailed</code> objects otherwise.
     */
    protected function doValidate($columns = null)
    {
        if (!$this->alreadyInValidation) {
            $this->alreadyInValidation = true;
            $retval = null;

            $failureMap = array();


            // We call the validate method on the following object(s) if they
            // were passed to this object by their corresponding set
            // method.  This object relates to these object(s) by a
            // foreign key reference.

            if ($this->aTagRelatedByParentId !== null) {
                if (!$this->aTagRelatedByParentId->validate($columns)) {
                    $failureMap = array_merge($failureMap, $this->aTagRelatedByParentId->getValidationFailures());
                }
            }

            if ($this->aTagType !== null) {
                if (!$this->aTagType->validate($columns)) {
                    $failureMap = array_merge($failureMap, $this->aTagType->getValidationFailures());
                }
            }


            if (($retval = TagPeer::doValidate($this, $columns)) !== true) {
                $failureMap = array_merge($failureMap, $retval);
            }


                if ($this->collOfferTags !== null) {
                    foreach ($this->collOfferTags as $referrerFK) {
                        if (!$referrerFK->validate($columns)) {
                            $failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
                        }
                    }
                }

                if ($this->collProductTags !== null) {
                    foreach ($this->collProductTags as $referrerFK) {
                        if (!$referrerFK->validate($columns)) {
                            $failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
                        }
                    }
                }

                if ($this->collTagsRelatedById !== null) {
                    foreach ($this->collTagsRelatedById as $referrerFK) {
                        if (!$referrerFK->validate($columns)) {
                            $failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
                        }
                    }
                }

                if ($this->collTagI18ns !== null) {
                    foreach ($this->collTagI18ns as $referrerFK) {
                        if (!$referrerFK->validate($columns)) {
                            $failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
                        }
                    }
                }


            $this->alreadyInValidation = false;
        }

        return (!empty($failureMap) ? $failureMap : true);
    }

    /**
     * Retrieves a field from the object by name passed in as a string.
     *
     * @param string $name name
     * @param string $type The type of fieldname the $name is of:
     *               one of the class type constants BasePeer::TYPE_PHPNAME, BasePeer::TYPE_STUDLYPHPNAME
     *               BasePeer::TYPE_COLNAME, BasePeer::TYPE_FIELDNAME, BasePeer::TYPE_NUM.
     *               Defaults to BasePeer::TYPE_PHPNAME
     * @return mixed Value of field.
     */
    public function getByName($name, $type = BasePeer::TYPE_PHPNAME)
    {
        $pos = TagPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
        $field = $this->getByPosition($pos);

        return $field;
    }

    /**
     * Retrieves a field from the object by Position as specified in the xml schema.
     * Zero-based.
     *
     * @param int $pos position in xml schema
     * @return mixed Value of field at $pos
     */
    public function getByPosition($pos)
    {
        switch ($pos) {
            case 0:
                return $this->getId();
                break;
            case 1:
                return $this->getTypeId();
                break;
            case 2:
                return $this->getParentId();
                break;
            case 3:
                return $this->getActive();
                break;
            case 4:
                return $this->getCreatedAt();
                break;
            case 5:
                return $this->getUpdatedAt();
                break;
            default:
                return null;
                break;
        } // switch()
    }

    /**
     * Exports the object as an array.
     *
     * You can specify the key type of the array by passing one of the class
     * type constants.
     *
     * @param     string  $keyType (optional) One of the class type constants BasePeer::TYPE_PHPNAME, BasePeer::TYPE_STUDLYPHPNAME,
     *                    BasePeer::TYPE_COLNAME, BasePeer::TYPE_FIELDNAME, BasePeer::TYPE_NUM.
     *                    Defaults to BasePeer::TYPE_PHPNAME.
     * @param     boolean $includeLazyLoadColumns (optional) Whether to include lazy loaded columns. Defaults to true.
     * @param     array $alreadyDumpedObjects List of objects to skip to avoid recursion
     * @param     boolean $includeForeignObjects (optional) Whether to include hydrated related objects. Default to FALSE.
     *
     * @return array an associative array containing the field names (as keys) and field values
     */
    public function toArray($keyType = BasePeer::TYPE_PHPNAME, $includeLazyLoadColumns = true, $alreadyDumpedObjects = array(), $includeForeignObjects = false)
    {
        if (isset($alreadyDumpedObjects['Tag'][$this->getPrimaryKey()])) {
            return '*RECURSION*';
        }
        $alreadyDumpedObjects['Tag'][$this->getPrimaryKey()] = true;
        $keys = TagPeer::getFieldNames($keyType);
        $result = array(
            $keys[0] => $this->getId(),
            $keys[1] => $this->getTypeId(),
            $keys[2] => $this->getParentId(),
            $keys[3] => $this->getActive(),
            $keys[4] => $this->getCreatedAt(),
            $keys[5] => $this->getUpdatedAt(),
        );
        $virtualColumns = $this->virtualColumns;
        foreach ($virtualColumns as $key => $virtualColumn) {
            $result[$key] = $virtualColumn;
        }

        if ($includeForeignObjects) {
            if (null !== $this->aTagRelatedByParentId) {
                $result['TagRelatedByParentId'] = $this->aTagRelatedByParentId->toArray($keyType, $includeLazyLoadColumns,  $alreadyDumpedObjects, true);
            }
            if (null !== $this->aTagType) {
                $result['TagType'] = $this->aTagType->toArray($keyType, $includeLazyLoadColumns,  $alreadyDumpedObjects, true);
            }
            if (null !== $this->collOfferTags) {
                $result['OfferTags'] = $this->collOfferTags->toArray(null, true, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
            }
            if (null !== $this->collProductTags) {
                $result['ProductTags'] = $this->collProductTags->toArray(null, true, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
            }
            if (null !== $this->collTagsRelatedById) {
                $result['TagsRelatedById'] = $this->collTagsRelatedById->toArray(null, true, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
            }
            if (null !== $this->collTagI18ns) {
                $result['TagI18ns'] = $this->collTagI18ns->toArray(null, true, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
            }
        }

        return $result;
    }

    /**
     * Sets a field from the object by name passed in as a string.
     *
     * @param string $name peer name
     * @param mixed $value field value
     * @param string $type The type of fieldname the $name is of:
     *                     one of the class type constants BasePeer::TYPE_PHPNAME, BasePeer::TYPE_STUDLYPHPNAME
     *                     BasePeer::TYPE_COLNAME, BasePeer::TYPE_FIELDNAME, BasePeer::TYPE_NUM.
     *                     Defaults to BasePeer::TYPE_PHPNAME
     * @return void
     */
    public function setByName($name, $value, $type = BasePeer::TYPE_PHPNAME)
    {
        $pos = TagPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);

        $this->setByPosition($pos, $value);
    }

    /**
     * Sets a field from the object by Position as specified in the xml schema.
     * Zero-based.
     *
     * @param int $pos position in xml schema
     * @param mixed $value field value
     * @return void
     */
    public function setByPosition($pos, $value)
    {
        switch ($pos) {
            case 0:
                $this->setId($value);
                break;
            case 1:
                $this->setTypeId($value);
                break;
            case 2:
                $this->setParentId($value);
                break;
            case 3:
                $this->setActive($value);
                break;
            case 4:
                $this->setCreatedAt($value);
                break;
            case 5:
                $this->setUpdatedAt($value);
                break;
        } // switch()
    }

    /**
     * Populates the object using an array.
     *
     * This is particularly useful when populating an object from one of the
     * request arrays (e.g. $_POST).  This method goes through the column
     * names, checking to see whether a matching key exists in populated
     * array. If so the setByName() method is called for that column.
     *
     * You can specify the key type of the array by additionally passing one
     * of the class type constants BasePeer::TYPE_PHPNAME, BasePeer::TYPE_STUDLYPHPNAME,
     * BasePeer::TYPE_COLNAME, BasePeer::TYPE_FIELDNAME, BasePeer::TYPE_NUM.
     * The default key type is the column's BasePeer::TYPE_PHPNAME
     *
     * @param array  $arr     An array to populate the object from.
     * @param string $keyType The type of keys the array uses.
     * @return void
     */
    public function fromArray($arr, $keyType = BasePeer::TYPE_PHPNAME)
    {
        $keys = TagPeer::getFieldNames($keyType);

        if (array_key_exists($keys[0], $arr)) $this->setId($arr[$keys[0]]);
        if (array_key_exists($keys[1], $arr)) $this->setTypeId($arr[$keys[1]]);
        if (array_key_exists($keys[2], $arr)) $this->setParentId($arr[$keys[2]]);
        if (array_key_exists($keys[3], $arr)) $this->setActive($arr[$keys[3]]);
        if (array_key_exists($keys[4], $arr)) $this->setCreatedAt($arr[$keys[4]]);
        if (array_key_exists($keys[5], $arr)) $this->setUpdatedAt($arr[$keys[5]]);
    }

    /**
     * Build a Criteria object containing the values of all modified columns in this object.
     *
     * @return Criteria The Criteria object containing all modified values.
     */
    public function buildCriteria()
    {
        $criteria = new Criteria(TagPeer::DATABASE_NAME);

        if ($this->isColumnModified(TagPeer::ID)) $criteria->add(TagPeer::ID, $this->id);
        if ($this->isColumnModified(TagPeer::TYPE_ID)) $criteria->add(TagPeer::TYPE_ID, $this->type_id);
        if ($this->isColumnModified(TagPeer::PARENT_ID)) $criteria->add(TagPeer::PARENT_ID, $this->parent_id);
        if ($this->isColumnModified(TagPeer::ACTIVE)) $criteria->add(TagPeer::ACTIVE, $this->active);
        if ($this->isColumnModified(TagPeer::CREATED_AT)) $criteria->add(TagPeer::CREATED_AT, $this->created_at);
        if ($this->isColumnModified(TagPeer::UPDATED_AT)) $criteria->add(TagPeer::UPDATED_AT, $this->updated_at);

        return $criteria;
    }

    /**
     * Builds a Criteria object containing the primary key for this object.
     *
     * Unlike buildCriteria() this method includes the primary key values regardless
     * of whether or not they have been modified.
     *
     * @return Criteria The Criteria object containing value(s) for primary key(s).
     */
    public function buildPkeyCriteria()
    {
        $criteria = new Criteria(TagPeer::DATABASE_NAME);
        $criteria->add(TagPeer::ID, $this->id);

        return $criteria;
    }

    /**
     * Returns the primary key for this object (row).
     * @return int
     */
    public function getPrimaryKey()
    {
        return $this->getId();
    }

    /**
     * Generic method to set the primary key (id column).
     *
     * @param  int $key Primary key.
     * @return void
     */
    public function setPrimaryKey($key)
    {
        $this->setId($key);
    }

    /**
     * Returns true if the primary key for this object is null.
     * @return boolean
     */
    public function isPrimaryKeyNull()
    {

        return null === $this->getId();
    }

    /**
     * Sets contents of passed object to values from current object.
     *
     * If desired, this method can also make copies of all associated (fkey referrers)
     * objects.
     *
     * @param object $copyObj An object of Tag (or compatible) type.
     * @param boolean $deepCopy Whether to also copy all rows that refer (by fkey) to the current row.
     * @param boolean $makeNew Whether to reset autoincrement PKs and make the object new.
     * @throws PropelException
     */
    public function copyInto($copyObj, $deepCopy = false, $makeNew = true)
    {
        $copyObj->setTypeId($this->getTypeId());
        $copyObj->setParentId($this->getParentId());
        $copyObj->setActive($this->getActive());
        $copyObj->setCreatedAt($this->getCreatedAt());
        $copyObj->setUpdatedAt($this->getUpdatedAt());

        if ($deepCopy && !$this->startCopy) {
            // important: temporarily setNew(false) because this affects the behavior of
            // the getter/setter methods for fkey referrer objects.
            $copyObj->setNew(false);
            // store object hash to prevent cycle
            $this->startCopy = true;

            foreach ($this->getOfferTags() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addOfferTag($relObj->copy($deepCopy));
                }
            }

            foreach ($this->getProductTags() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addProductTag($relObj->copy($deepCopy));
                }
            }

            foreach ($this->getTagsRelatedById() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addTagRelatedById($relObj->copy($deepCopy));
                }
            }

            foreach ($this->getTagI18ns() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addTagI18n($relObj->copy($deepCopy));
                }
            }

            //unflag object copy
            $this->startCopy = false;
        } // if ($deepCopy)

        if ($makeNew) {
            $copyObj->setNew(true);
            $copyObj->setId(NULL); // this is a auto-increment column, so set to default value
        }
    }

    /**
     * Makes a copy of this object that will be inserted as a new row in table when saved.
     * It creates a new object filling in the simple attributes, but skipping any primary
     * keys that are defined for the table.
     *
     * If desired, this method can also make copies of all associated (fkey referrers)
     * objects.
     *
     * @param boolean $deepCopy Whether to also copy all rows that refer (by fkey) to the current row.
     * @return Tag Clone of current object.
     * @throws PropelException
     */
    public function copy($deepCopy = false)
    {
        // we use get_class(), because this might be a subclass
        $clazz = get_class($this);
        $copyObj = new $clazz();
        $this->copyInto($copyObj, $deepCopy);

        return $copyObj;
    }

    /**
     * Returns a peer instance associated with this om.
     *
     * Since Peer classes are not to have any instance attributes, this method returns the
     * same instance for all member of this class. The method could therefore
     * be static, but this would prevent one from overriding the behavior.
     *
     * @return TagPeer
     */
    public function getPeer()
    {
        if (self::$peer === null) {
            self::$peer = new TagPeer();
        }

        return self::$peer;
    }

    /**
     * Declares an association between this object and a Tag object.
     *
     * @param                  Tag $v
     * @return Tag The current object (for fluent API support)
     * @throws PropelException
     */
    public function setTagRelatedByParentId(Tag $v = null)
    {
        if ($v === null) {
            $this->setParentId(NULL);
        } else {
            $this->setParentId($v->getId());
        }

        $this->aTagRelatedByParentId = $v;

        // Add binding for other direction of this n:n relationship.
        // If this object has already been added to the Tag object, it will not be re-added.
        if ($v !== null) {
            $v->addTagRelatedById($this);
        }


        return $this;
    }


    /**
     * Get the associated Tag object
     *
     * @param PropelPDO $con Optional Connection object.
     * @param $doQuery Executes a query to get the object if required
     * @return Tag The associated Tag object.
     * @throws PropelException
     */
    public function getTagRelatedByParentId(PropelPDO $con = null, $doQuery = true)
    {
        if ($this->aTagRelatedByParentId === null && ($this->parent_id !== null) && $doQuery) {
            $this->aTagRelatedByParentId = TagQuery::create()->findPk($this->parent_id, $con);
            /* The following can be used additionally to
                guarantee the related object contains a reference
                to this object.  This level of coupling may, however, be
                undesirable since it could result in an only partially populated collection
                in the referenced object.
                $this->aTagRelatedByParentId->addTagsRelatedById($this);
             */
        }

        return $this->aTagRelatedByParentId;
    }

    /**
     * Declares an association between this object and a TagType object.
     *
     * @param                  TagType $v
     * @return Tag The current object (for fluent API support)
     * @throws PropelException
     */
    public function setTagType(TagType $v = null)
    {
        if ($v === null) {
            $this->setTypeId(NULL);
        } else {
            $this->setTypeId($v->getId());
        }

        $this->aTagType = $v;

        // Add binding for other direction of this n:n relationship.
        // If this object has already been added to the TagType object, it will not be re-added.
        if ($v !== null) {
            $v->addTag($this);
        }


        return $this;
    }


    /**
     * Get the associated TagType object
     *
     * @param PropelPDO $con Optional Connection object.
     * @param $doQuery Executes a query to get the object if required
     * @return TagType The associated TagType object.
     * @throws PropelException
     */
    public function getTagType(PropelPDO $con = null, $doQuery = true)
    {
        if ($this->aTagType === null && ($this->type_id !== null) && $doQuery) {
            $this->aTagType = TagTypeQuery::create()->findPk($this->type_id, $con);
            /* The following can be used additionally to
                guarantee the related object contains a reference
                to this object.  This level of coupling may, however, be
                undesirable since it could result in an only partially populated collection
                in the referenced object.
                $this->aTagType->addTags($this);
             */
        }

        return $this->aTagType;
    }


    /**
     * Initializes a collection based on the name of a relation.
     * Avoids crafting an 'init[$relationName]s' method name
     * that wouldn't work when StandardEnglishPluralizer is used.
     *
     * @param string $relationName The name of the relation to initialize
     * @return void
     */
    public function initRelation($relationName)
    {
        if ('OfferTag' == $relationName) {
            $this->initOfferTags();
        }
        if ('ProductTag' == $relationName) {
            $this->initProductTags();
        }
        if ('TagRelatedById' == $relationName) {
            $this->initTagsRelatedById();
        }
        if ('TagI18n' == $relationName) {
            $this->initTagI18ns();
        }
    }

    /**
     * Clears out the collOfferTags collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return Tag The current object (for fluent API support)
     * @see        addOfferTags()
     */
    public function clearOfferTags()
    {
        $this->collOfferTags = null; // important to set this to null since that means it is uninitialized
        $this->collOfferTagsPartial = null;

        return $this;
    }

    /**
     * reset is the collOfferTags collection loaded partially
     *
     * @return void
     */
    public function resetPartialOfferTags($v = true)
    {
        $this->collOfferTagsPartial = $v;
    }

    /**
     * Initializes the collOfferTags collection.
     *
     * By default this just sets the collOfferTags collection to an empty array (like clearcollOfferTags());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param boolean $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initOfferTags($overrideExisting = true)
    {
        if (null !== $this->collOfferTags && !$overrideExisting) {
            return;
        }
        $this->collOfferTags = new PropelObjectCollection();
        $this->collOfferTags->setModel('OfferTag');
    }

    /**
     * Gets an array of OfferTag objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this Tag is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param PropelPDO $con optional connection object
     * @return PropelObjectCollection|OfferTag[] List of OfferTag objects
     * @throws PropelException
     */
    public function getOfferTags($criteria = null, PropelPDO $con = null)
    {
        $partial = $this->collOfferTagsPartial && !$this->isNew();
        if (null === $this->collOfferTags || null !== $criteria  || $partial) {
            if ($this->isNew() && null === $this->collOfferTags) {
                // return empty collection
                $this->initOfferTags();
            } else {
                $collOfferTags = OfferTagQuery::create(null, $criteria)
                    ->filterByTag($this)
                    ->find($con);
                if (null !== $criteria) {
                    if (false !== $this->collOfferTagsPartial && count($collOfferTags)) {
                      $this->initOfferTags(false);

                      foreach ($collOfferTags as $obj) {
                        if (false == $this->collOfferTags->contains($obj)) {
                          $this->collOfferTags->append($obj);
                        }
                      }

                      $this->collOfferTagsPartial = true;
                    }

                    $collOfferTags->getInternalIterator()->rewind();

                    return $collOfferTags;
                }

                if ($partial && $this->collOfferTags) {
                    foreach ($this->collOfferTags as $obj) {
                        if ($obj->isNew()) {
                            $collOfferTags[] = $obj;
                        }
                    }
                }

                $this->collOfferTags = $collOfferTags;
                $this->collOfferTagsPartial = false;
            }
        }

        return $this->collOfferTags;
    }

    /**
     * Sets a collection of OfferTag objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param PropelCollection $offerTags A Propel collection.
     * @param PropelPDO $con Optional connection object
     * @return Tag The current object (for fluent API support)
     */
    public function setOfferTags(PropelCollection $offerTags, PropelPDO $con = null)
    {
        $offerTagsToDelete = $this->getOfferTags(new Criteria(), $con)->diff($offerTags);


        $this->offerTagsScheduledForDeletion = $offerTagsToDelete;

        foreach ($offerTagsToDelete as $offerTagRemoved) {
            $offerTagRemoved->setTag(null);
        }

        $this->collOfferTags = null;
        foreach ($offerTags as $offerTag) {
            $this->addOfferTag($offerTag);
        }

        $this->collOfferTags = $offerTags;
        $this->collOfferTagsPartial = false;

        return $this;
    }

    /**
     * Returns the number of related OfferTag objects.
     *
     * @param Criteria $criteria
     * @param boolean $distinct
     * @param PropelPDO $con
     * @return int             Count of related OfferTag objects.
     * @throws PropelException
     */
    public function countOfferTags(Criteria $criteria = null, $distinct = false, PropelPDO $con = null)
    {
        $partial = $this->collOfferTagsPartial && !$this->isNew();
        if (null === $this->collOfferTags || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collOfferTags) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getOfferTags());
            }
            $query = OfferTagQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterByTag($this)
                ->count($con);
        }

        return count($this->collOfferTags);
    }

    /**
     * Method called to associate a OfferTag object to this object
     * through the OfferTag foreign key attribute.
     *
     * @param    OfferTag $l OfferTag
     * @return Tag The current object (for fluent API support)
     */
    public function addOfferTag(OfferTag $l)
    {
        if ($this->collOfferTags === null) {
            $this->initOfferTags();
            $this->collOfferTagsPartial = true;
        }

        if (!in_array($l, $this->collOfferTags->getArrayCopy(), true)) { // only add it if the **same** object is not already associated
            $this->doAddOfferTag($l);

            if ($this->offerTagsScheduledForDeletion and $this->offerTagsScheduledForDeletion->contains($l)) {
                $this->offerTagsScheduledForDeletion->remove($this->offerTagsScheduledForDeletion->search($l));
            }
        }

        return $this;
    }

    /**
     * @param	OfferTag $offerTag The offerTag object to add.
     */
    protected function doAddOfferTag($offerTag)
    {
        $this->collOfferTags[]= $offerTag;
        $offerTag->setTag($this);
    }

    /**
     * @param	OfferTag $offerTag The offerTag object to remove.
     * @return Tag The current object (for fluent API support)
     */
    public function removeOfferTag($offerTag)
    {
        if ($this->getOfferTags()->contains($offerTag)) {
            $this->collOfferTags->remove($this->collOfferTags->search($offerTag));
            if (null === $this->offerTagsScheduledForDeletion) {
                $this->offerTagsScheduledForDeletion = clone $this->collOfferTags;
                $this->offerTagsScheduledForDeletion->clear();
            }
            $this->offerTagsScheduledForDeletion[]= clone $offerTag;
            $offerTag->setTag(null);
        }

        return $this;
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Tag is new, it will return
     * an empty collection; or if this Tag has previously
     * been saved, it will retrieve related OfferTags from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Tag.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param PropelPDO $con optional connection object
     * @param string $join_behavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return PropelObjectCollection|OfferTag[] List of OfferTag objects
     */
    public function getOfferTagsJoinOffer($criteria = null, $con = null, $join_behavior = Criteria::LEFT_JOIN)
    {
        $query = OfferTagQuery::create(null, $criteria);
        $query->joinWith('Offer', $join_behavior);

        return $this->getOfferTags($query, $con);
    }

    /**
     * Clears out the collProductTags collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return Tag The current object (for fluent API support)
     * @see        addProductTags()
     */
    public function clearProductTags()
    {
        $this->collProductTags = null; // important to set this to null since that means it is uninitialized
        $this->collProductTagsPartial = null;

        return $this;
    }

    /**
     * reset is the collProductTags collection loaded partially
     *
     * @return void
     */
    public function resetPartialProductTags($v = true)
    {
        $this->collProductTagsPartial = $v;
    }

    /**
     * Initializes the collProductTags collection.
     *
     * By default this just sets the collProductTags collection to an empty array (like clearcollProductTags());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param boolean $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initProductTags($overrideExisting = true)
    {
        if (null !== $this->collProductTags && !$overrideExisting) {
            return;
        }
        $this->collProductTags = new PropelObjectCollection();
        $this->collProductTags->setModel('ProductTag');
    }

    /**
     * Gets an array of ProductTag objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this Tag is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param PropelPDO $con optional connection object
     * @return PropelObjectCollection|ProductTag[] List of ProductTag objects
     * @throws PropelException
     */
    public function getProductTags($criteria = null, PropelPDO $con = null)
    {
        $partial = $this->collProductTagsPartial && !$this->isNew();
        if (null === $this->collProductTags || null !== $criteria  || $partial) {
            if ($this->isNew() && null === $this->collProductTags) {
                // return empty collection
                $this->initProductTags();
            } else {
                $collProductTags = ProductTagQuery::create(null, $criteria)
                    ->filterByTag($this)
                    ->find($con);
                if (null !== $criteria) {
                    if (false !== $this->collProductTagsPartial && count($collProductTags)) {
                      $this->initProductTags(false);

                      foreach ($collProductTags as $obj) {
                        if (false == $this->collProductTags->contains($obj)) {
                          $this->collProductTags->append($obj);
                        }
                      }

                      $this->collProductTagsPartial = true;
                    }

                    $collProductTags->getInternalIterator()->rewind();

                    return $collProductTags;
                }

                if ($partial && $this->collProductTags) {
                    foreach ($this->collProductTags as $obj) {
                        if ($obj->isNew()) {
                            $collProductTags[] = $obj;
                        }
                    }
                }

                $this->collProductTags = $collProductTags;
                $this->collProductTagsPartial = false;
            }
        }

        return $this->collProductTags;
    }

    /**
     * Sets a collection of ProductTag objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param PropelCollection $productTags A Propel collection.
     * @param PropelPDO $con Optional connection object
     * @return Tag The current object (for fluent API support)
     */
    public function setProductTags(PropelCollection $productTags, PropelPDO $con = null)
    {
        $productTagsToDelete = $this->getProductTags(new Criteria(), $con)->diff($productTags);


        $this->productTagsScheduledForDeletion = $productTagsToDelete;

        foreach ($productTagsToDelete as $productTagRemoved) {
            $productTagRemoved->setTag(null);
        }

        $this->collProductTags = null;
        foreach ($productTags as $productTag) {
            $this->addProductTag($productTag);
        }

        $this->collProductTags = $productTags;
        $this->collProductTagsPartial = false;

        return $this;
    }

    /**
     * Returns the number of related ProductTag objects.
     *
     * @param Criteria $criteria
     * @param boolean $distinct
     * @param PropelPDO $con
     * @return int             Count of related ProductTag objects.
     * @throws PropelException
     */
    public function countProductTags(Criteria $criteria = null, $distinct = false, PropelPDO $con = null)
    {
        $partial = $this->collProductTagsPartial && !$this->isNew();
        if (null === $this->collProductTags || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collProductTags) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getProductTags());
            }
            $query = ProductTagQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterByTag($this)
                ->count($con);
        }

        return count($this->collProductTags);
    }

    /**
     * Method called to associate a ProductTag object to this object
     * through the ProductTag foreign key attribute.
     *
     * @param    ProductTag $l ProductTag
     * @return Tag The current object (for fluent API support)
     */
    public function addProductTag(ProductTag $l)
    {
        if ($this->collProductTags === null) {
            $this->initProductTags();
            $this->collProductTagsPartial = true;
        }

        if (!in_array($l, $this->collProductTags->getArrayCopy(), true)) { // only add it if the **same** object is not already associated
            $this->doAddProductTag($l);

            if ($this->productTagsScheduledForDeletion and $this->productTagsScheduledForDeletion->contains($l)) {
                $this->productTagsScheduledForDeletion->remove($this->productTagsScheduledForDeletion->search($l));
            }
        }

        return $this;
    }

    /**
     * @param	ProductTag $productTag The productTag object to add.
     */
    protected function doAddProductTag($productTag)
    {
        $this->collProductTags[]= $productTag;
        $productTag->setTag($this);
    }

    /**
     * @param	ProductTag $productTag The productTag object to remove.
     * @return Tag The current object (for fluent API support)
     */
    public function removeProductTag($productTag)
    {
        if ($this->getProductTags()->contains($productTag)) {
            $this->collProductTags->remove($this->collProductTags->search($productTag));
            if (null === $this->productTagsScheduledForDeletion) {
                $this->productTagsScheduledForDeletion = clone $this->collProductTags;
                $this->productTagsScheduledForDeletion->clear();
            }
            $this->productTagsScheduledForDeletion[]= clone $productTag;
            $productTag->setTag(null);
        }

        return $this;
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Tag is new, it will return
     * an empty collection; or if this Tag has previously
     * been saved, it will retrieve related ProductTags from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Tag.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param PropelPDO $con optional connection object
     * @param string $join_behavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return PropelObjectCollection|ProductTag[] List of ProductTag objects
     */
    public function getProductTagsJoinProduct($criteria = null, $con = null, $join_behavior = Criteria::LEFT_JOIN)
    {
        $query = ProductTagQuery::create(null, $criteria);
        $query->joinWith('Product', $join_behavior);

        return $this->getProductTags($query, $con);
    }

    /**
     * Clears out the collTagsRelatedById collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return Tag The current object (for fluent API support)
     * @see        addTagsRelatedById()
     */
    public function clearTagsRelatedById()
    {
        $this->collTagsRelatedById = null; // important to set this to null since that means it is uninitialized
        $this->collTagsRelatedByIdPartial = null;

        return $this;
    }

    /**
     * reset is the collTagsRelatedById collection loaded partially
     *
     * @return void
     */
    public function resetPartialTagsRelatedById($v = true)
    {
        $this->collTagsRelatedByIdPartial = $v;
    }

    /**
     * Initializes the collTagsRelatedById collection.
     *
     * By default this just sets the collTagsRelatedById collection to an empty array (like clearcollTagsRelatedById());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param boolean $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initTagsRelatedById($overrideExisting = true)
    {
        if (null !== $this->collTagsRelatedById && !$overrideExisting) {
            return;
        }
        $this->collTagsRelatedById = new PropelObjectCollection();
        $this->collTagsRelatedById->setModel('Tag');
    }

    /**
     * Gets an array of Tag objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this Tag is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param PropelPDO $con optional connection object
     * @return PropelObjectCollection|Tag[] List of Tag objects
     * @throws PropelException
     */
    public function getTagsRelatedById($criteria = null, PropelPDO $con = null)
    {
        $partial = $this->collTagsRelatedByIdPartial && !$this->isNew();
        if (null === $this->collTagsRelatedById || null !== $criteria  || $partial) {
            if ($this->isNew() && null === $this->collTagsRelatedById) {
                // return empty collection
                $this->initTagsRelatedById();
            } else {
                $collTagsRelatedById = TagQuery::create(null, $criteria)
                    ->filterByTagRelatedByParentId($this)
                    ->find($con);
                if (null !== $criteria) {
                    if (false !== $this->collTagsRelatedByIdPartial && count($collTagsRelatedById)) {
                      $this->initTagsRelatedById(false);

                      foreach ($collTagsRelatedById as $obj) {
                        if (false == $this->collTagsRelatedById->contains($obj)) {
                          $this->collTagsRelatedById->append($obj);
                        }
                      }

                      $this->collTagsRelatedByIdPartial = true;
                    }

                    $collTagsRelatedById->getInternalIterator()->rewind();

                    return $collTagsRelatedById;
                }

                if ($partial && $this->collTagsRelatedById) {
                    foreach ($this->collTagsRelatedById as $obj) {
                        if ($obj->isNew()) {
                            $collTagsRelatedById[] = $obj;
                        }
                    }
                }

                $this->collTagsRelatedById = $collTagsRelatedById;
                $this->collTagsRelatedByIdPartial = false;
            }
        }

        return $this->collTagsRelatedById;
    }

    /**
     * Sets a collection of TagRelatedById objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param PropelCollection $tagsRelatedById A Propel collection.
     * @param PropelPDO $con Optional connection object
     * @return Tag The current object (for fluent API support)
     */
    public function setTagsRelatedById(PropelCollection $tagsRelatedById, PropelPDO $con = null)
    {
        $tagsRelatedByIdToDelete = $this->getTagsRelatedById(new Criteria(), $con)->diff($tagsRelatedById);


        $this->tagsRelatedByIdScheduledForDeletion = $tagsRelatedByIdToDelete;

        foreach ($tagsRelatedByIdToDelete as $tagRelatedByIdRemoved) {
            $tagRelatedByIdRemoved->setTagRelatedByParentId(null);
        }

        $this->collTagsRelatedById = null;
        foreach ($tagsRelatedById as $tagRelatedById) {
            $this->addTagRelatedById($tagRelatedById);
        }

        $this->collTagsRelatedById = $tagsRelatedById;
        $this->collTagsRelatedByIdPartial = false;

        return $this;
    }

    /**
     * Returns the number of related Tag objects.
     *
     * @param Criteria $criteria
     * @param boolean $distinct
     * @param PropelPDO $con
     * @return int             Count of related Tag objects.
     * @throws PropelException
     */
    public function countTagsRelatedById(Criteria $criteria = null, $distinct = false, PropelPDO $con = null)
    {
        $partial = $this->collTagsRelatedByIdPartial && !$this->isNew();
        if (null === $this->collTagsRelatedById || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collTagsRelatedById) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getTagsRelatedById());
            }
            $query = TagQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterByTagRelatedByParentId($this)
                ->count($con);
        }

        return count($this->collTagsRelatedById);
    }

    /**
     * Method called to associate a Tag object to this object
     * through the Tag foreign key attribute.
     *
     * @param    Tag $l Tag
     * @return Tag The current object (for fluent API support)
     */
    public function addTagRelatedById(Tag $l)
    {
        if ($this->collTagsRelatedById === null) {
            $this->initTagsRelatedById();
            $this->collTagsRelatedByIdPartial = true;
        }

        if (!in_array($l, $this->collTagsRelatedById->getArrayCopy(), true)) { // only add it if the **same** object is not already associated
            $this->doAddTagRelatedById($l);

            if ($this->tagsRelatedByIdScheduledForDeletion and $this->tagsRelatedByIdScheduledForDeletion->contains($l)) {
                $this->tagsRelatedByIdScheduledForDeletion->remove($this->tagsRelatedByIdScheduledForDeletion->search($l));
            }
        }

        return $this;
    }

    /**
     * @param	TagRelatedById $tagRelatedById The tagRelatedById object to add.
     */
    protected function doAddTagRelatedById($tagRelatedById)
    {
        $this->collTagsRelatedById[]= $tagRelatedById;
        $tagRelatedById->setTagRelatedByParentId($this);
    }

    /**
     * @param	TagRelatedById $tagRelatedById The tagRelatedById object to remove.
     * @return Tag The current object (for fluent API support)
     */
    public function removeTagRelatedById($tagRelatedById)
    {
        if ($this->getTagsRelatedById()->contains($tagRelatedById)) {
            $this->collTagsRelatedById->remove($this->collTagsRelatedById->search($tagRelatedById));
            if (null === $this->tagsRelatedByIdScheduledForDeletion) {
                $this->tagsRelatedByIdScheduledForDeletion = clone $this->collTagsRelatedById;
                $this->tagsRelatedByIdScheduledForDeletion->clear();
            }
            $this->tagsRelatedByIdScheduledForDeletion[]= $tagRelatedById;
            $tagRelatedById->setTagRelatedByParentId(null);
        }

        return $this;
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Tag is new, it will return
     * an empty collection; or if this Tag has previously
     * been saved, it will retrieve related TagsRelatedById from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Tag.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param PropelPDO $con optional connection object
     * @param string $join_behavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return PropelObjectCollection|Tag[] List of Tag objects
     */
    public function getTagsRelatedByIdJoinTagType($criteria = null, $con = null, $join_behavior = Criteria::LEFT_JOIN)
    {
        $query = TagQuery::create(null, $criteria);
        $query->joinWith('TagType', $join_behavior);

        return $this->getTagsRelatedById($query, $con);
    }

    /**
     * Clears out the collTagI18ns collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return Tag The current object (for fluent API support)
     * @see        addTagI18ns()
     */
    public function clearTagI18ns()
    {
        $this->collTagI18ns = null; // important to set this to null since that means it is uninitialized
        $this->collTagI18nsPartial = null;

        return $this;
    }

    /**
     * reset is the collTagI18ns collection loaded partially
     *
     * @return void
     */
    public function resetPartialTagI18ns($v = true)
    {
        $this->collTagI18nsPartial = $v;
    }

    /**
     * Initializes the collTagI18ns collection.
     *
     * By default this just sets the collTagI18ns collection to an empty array (like clearcollTagI18ns());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param boolean $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initTagI18ns($overrideExisting = true)
    {
        if (null !== $this->collTagI18ns && !$overrideExisting) {
            return;
        }
        $this->collTagI18ns = new PropelObjectCollection();
        $this->collTagI18ns->setModel('TagI18n');
    }

    /**
     * Gets an array of TagI18n objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this Tag is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param PropelPDO $con optional connection object
     * @return PropelObjectCollection|TagI18n[] List of TagI18n objects
     * @throws PropelException
     */
    public function getTagI18ns($criteria = null, PropelPDO $con = null)
    {
        $partial = $this->collTagI18nsPartial && !$this->isNew();
        if (null === $this->collTagI18ns || null !== $criteria  || $partial) {
            if ($this->isNew() && null === $this->collTagI18ns) {
                // return empty collection
                $this->initTagI18ns();
            } else {
                $collTagI18ns = TagI18nQuery::create(null, $criteria)
                    ->filterByTag($this)
                    ->find($con);
                if (null !== $criteria) {
                    if (false !== $this->collTagI18nsPartial && count($collTagI18ns)) {
                      $this->initTagI18ns(false);

                      foreach ($collTagI18ns as $obj) {
                        if (false == $this->collTagI18ns->contains($obj)) {
                          $this->collTagI18ns->append($obj);
                        }
                      }

                      $this->collTagI18nsPartial = true;
                    }

                    $collTagI18ns->getInternalIterator()->rewind();

                    return $collTagI18ns;
                }

                if ($partial && $this->collTagI18ns) {
                    foreach ($this->collTagI18ns as $obj) {
                        if ($obj->isNew()) {
                            $collTagI18ns[] = $obj;
                        }
                    }
                }

                $this->collTagI18ns = $collTagI18ns;
                $this->collTagI18nsPartial = false;
            }
        }

        return $this->collTagI18ns;
    }

    /**
     * Sets a collection of TagI18n objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param PropelCollection $tagI18ns A Propel collection.
     * @param PropelPDO $con Optional connection object
     * @return Tag The current object (for fluent API support)
     */
    public function setTagI18ns(PropelCollection $tagI18ns, PropelPDO $con = null)
    {
        $tagI18nsToDelete = $this->getTagI18ns(new Criteria(), $con)->diff($tagI18ns);


        //since at least one column in the foreign key is at the same time a PK
        //we can not just set a PK to NULL in the lines below. We have to store
        //a backup of all values, so we are able to manipulate these items based on the onDelete value later.
        $this->tagI18nsScheduledForDeletion = clone $tagI18nsToDelete;

        foreach ($tagI18nsToDelete as $tagI18nRemoved) {
            $tagI18nRemoved->setTag(null);
        }

        $this->collTagI18ns = null;
        foreach ($tagI18ns as $tagI18n) {
            $this->addTagI18n($tagI18n);
        }

        $this->collTagI18ns = $tagI18ns;
        $this->collTagI18nsPartial = false;

        return $this;
    }

    /**
     * Returns the number of related TagI18n objects.
     *
     * @param Criteria $criteria
     * @param boolean $distinct
     * @param PropelPDO $con
     * @return int             Count of related TagI18n objects.
     * @throws PropelException
     */
    public function countTagI18ns(Criteria $criteria = null, $distinct = false, PropelPDO $con = null)
    {
        $partial = $this->collTagI18nsPartial && !$this->isNew();
        if (null === $this->collTagI18ns || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collTagI18ns) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getTagI18ns());
            }
            $query = TagI18nQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterByTag($this)
                ->count($con);
        }

        return count($this->collTagI18ns);
    }

    /**
     * Method called to associate a TagI18n object to this object
     * through the TagI18n foreign key attribute.
     *
     * @param    TagI18n $l TagI18n
     * @return Tag The current object (for fluent API support)
     */
    public function addTagI18n(TagI18n $l)
    {
        if ($l && $locale = $l->getLocale()) {
            $this->setLocale($locale);
            $this->currentTranslations[$locale] = $l;
        }
        if ($this->collTagI18ns === null) {
            $this->initTagI18ns();
            $this->collTagI18nsPartial = true;
        }

        if (!in_array($l, $this->collTagI18ns->getArrayCopy(), true)) { // only add it if the **same** object is not already associated
            $this->doAddTagI18n($l);

            if ($this->tagI18nsScheduledForDeletion and $this->tagI18nsScheduledForDeletion->contains($l)) {
                $this->tagI18nsScheduledForDeletion->remove($this->tagI18nsScheduledForDeletion->search($l));
            }
        }

        return $this;
    }

    /**
     * @param	TagI18n $tagI18n The tagI18n object to add.
     */
    protected function doAddTagI18n($tagI18n)
    {
        $this->collTagI18ns[]= $tagI18n;
        $tagI18n->setTag($this);
    }

    /**
     * @param	TagI18n $tagI18n The tagI18n object to remove.
     * @return Tag The current object (for fluent API support)
     */
    public function removeTagI18n($tagI18n)
    {
        if ($this->getTagI18ns()->contains($tagI18n)) {
            $this->collTagI18ns->remove($this->collTagI18ns->search($tagI18n));
            if (null === $this->tagI18nsScheduledForDeletion) {
                $this->tagI18nsScheduledForDeletion = clone $this->collTagI18ns;
                $this->tagI18nsScheduledForDeletion->clear();
            }
            $this->tagI18nsScheduledForDeletion[]= clone $tagI18n;
            $tagI18n->setTag(null);
        }

        return $this;
    }

    /**
     * Clears out the collOffers collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return Tag The current object (for fluent API support)
     * @see        addOffers()
     */
    public function clearOffers()
    {
        $this->collOffers = null; // important to set this to null since that means it is uninitialized
        $this->collOffersPartial = null;

        return $this;
    }

    /**
     * Initializes the collOffers collection.
     *
     * By default this just sets the collOffers collection to an empty collection (like clearOffers());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @return void
     */
    public function initOffers()
    {
        $this->collOffers = new PropelObjectCollection();
        $this->collOffers->setModel('Offer');
    }

    /**
     * Gets a collection of Offer objects related by a many-to-many relationship
     * to the current object by way of the offer_tag cross-reference table.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this Tag is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param Criteria $criteria Optional query object to filter the query
     * @param PropelPDO $con Optional connection object
     *
     * @return PropelObjectCollection|Offer[] List of Offer objects
     */
    public function getOffers($criteria = null, PropelPDO $con = null)
    {
        if (null === $this->collOffers || null !== $criteria) {
            if ($this->isNew() && null === $this->collOffers) {
                // return empty collection
                $this->initOffers();
            } else {
                $collOffers = OfferQuery::create(null, $criteria)
                    ->filterByTag($this)
                    ->find($con);
                if (null !== $criteria) {
                    return $collOffers;
                }
                $this->collOffers = $collOffers;
            }
        }

        return $this->collOffers;
    }

    /**
     * Sets a collection of Offer objects related by a many-to-many relationship
     * to the current object by way of the offer_tag cross-reference table.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param PropelCollection $offers A Propel collection.
     * @param PropelPDO $con Optional connection object
     * @return Tag The current object (for fluent API support)
     */
    public function setOffers(PropelCollection $offers, PropelPDO $con = null)
    {
        $this->clearOffers();
        $currentOffers = $this->getOffers(null, $con);

        $this->offersScheduledForDeletion = $currentOffers->diff($offers);

        foreach ($offers as $offer) {
            if (!$currentOffers->contains($offer)) {
                $this->doAddOffer($offer);
            }
        }

        $this->collOffers = $offers;

        return $this;
    }

    /**
     * Gets the number of Offer objects related by a many-to-many relationship
     * to the current object by way of the offer_tag cross-reference table.
     *
     * @param Criteria $criteria Optional query object to filter the query
     * @param boolean $distinct Set to true to force count distinct
     * @param PropelPDO $con Optional connection object
     *
     * @return int the number of related Offer objects
     */
    public function countOffers($criteria = null, $distinct = false, PropelPDO $con = null)
    {
        if (null === $this->collOffers || null !== $criteria) {
            if ($this->isNew() && null === $this->collOffers) {
                return 0;
            } else {
                $query = OfferQuery::create(null, $criteria);
                if ($distinct) {
                    $query->distinct();
                }

                return $query
                    ->filterByTag($this)
                    ->count($con);
            }
        } else {
            return count($this->collOffers);
        }
    }

    /**
     * Associate a Offer object to this object
     * through the offer_tag cross reference table.
     *
     * @param  Offer $offer The OfferTag object to relate
     * @return Tag The current object (for fluent API support)
     */
    public function addOffer(Offer $offer)
    {
        if ($this->collOffers === null) {
            $this->initOffers();
        }

        if (!$this->collOffers->contains($offer)) { // only add it if the **same** object is not already associated
            $this->doAddOffer($offer);
            $this->collOffers[] = $offer;

            if ($this->offersScheduledForDeletion and $this->offersScheduledForDeletion->contains($offer)) {
                $this->offersScheduledForDeletion->remove($this->offersScheduledForDeletion->search($offer));
            }
        }

        return $this;
    }

    /**
     * @param	Offer $offer The offer object to add.
     */
    protected function doAddOffer(Offer $offer)
    {
        // set the back reference to this object directly as using provided method either results
        // in endless loop or in multiple relations
        if (!$offer->getTags()->contains($this)) { $offerTag = new OfferTag();
            $offerTag->setOffer($offer);
            $this->addOfferTag($offerTag);

            $foreignCollection = $offer->getTags();
            $foreignCollection[] = $this;
        }
    }

    /**
     * Remove a Offer object to this object
     * through the offer_tag cross reference table.
     *
     * @param Offer $offer The OfferTag object to relate
     * @return Tag The current object (for fluent API support)
     */
    public function removeOffer(Offer $offer)
    {
        if ($this->getOffers()->contains($offer)) {
            $this->collOffers->remove($this->collOffers->search($offer));
            if (null === $this->offersScheduledForDeletion) {
                $this->offersScheduledForDeletion = clone $this->collOffers;
                $this->offersScheduledForDeletion->clear();
            }
            $this->offersScheduledForDeletion[]= $offer;
        }

        return $this;
    }

    /**
     * Clears out the collProducts collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return Tag The current object (for fluent API support)
     * @see        addProducts()
     */
    public function clearProducts()
    {
        $this->collProducts = null; // important to set this to null since that means it is uninitialized
        $this->collProductsPartial = null;

        return $this;
    }

    /**
     * Initializes the collProducts collection.
     *
     * By default this just sets the collProducts collection to an empty collection (like clearProducts());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @return void
     */
    public function initProducts()
    {
        $this->collProducts = new PropelObjectCollection();
        $this->collProducts->setModel('Product');
    }

    /**
     * Gets a collection of Product objects related by a many-to-many relationship
     * to the current object by way of the product_tag cross-reference table.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this Tag is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param Criteria $criteria Optional query object to filter the query
     * @param PropelPDO $con Optional connection object
     *
     * @return PropelObjectCollection|Product[] List of Product objects
     */
    public function getProducts($criteria = null, PropelPDO $con = null)
    {
        if (null === $this->collProducts || null !== $criteria) {
            if ($this->isNew() && null === $this->collProducts) {
                // return empty collection
                $this->initProducts();
            } else {
                $collProducts = ProductQuery::create(null, $criteria)
                    ->filterByTag($this)
                    ->find($con);
                if (null !== $criteria) {
                    return $collProducts;
                }
                $this->collProducts = $collProducts;
            }
        }

        return $this->collProducts;
    }

    /**
     * Sets a collection of Product objects related by a many-to-many relationship
     * to the current object by way of the product_tag cross-reference table.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param PropelCollection $products A Propel collection.
     * @param PropelPDO $con Optional connection object
     * @return Tag The current object (for fluent API support)
     */
    public function setProducts(PropelCollection $products, PropelPDO $con = null)
    {
        $this->clearProducts();
        $currentProducts = $this->getProducts(null, $con);

        $this->productsScheduledForDeletion = $currentProducts->diff($products);

        foreach ($products as $product) {
            if (!$currentProducts->contains($product)) {
                $this->doAddProduct($product);
            }
        }

        $this->collProducts = $products;

        return $this;
    }

    /**
     * Gets the number of Product objects related by a many-to-many relationship
     * to the current object by way of the product_tag cross-reference table.
     *
     * @param Criteria $criteria Optional query object to filter the query
     * @param boolean $distinct Set to true to force count distinct
     * @param PropelPDO $con Optional connection object
     *
     * @return int the number of related Product objects
     */
    public function countProducts($criteria = null, $distinct = false, PropelPDO $con = null)
    {
        if (null === $this->collProducts || null !== $criteria) {
            if ($this->isNew() && null === $this->collProducts) {
                return 0;
            } else {
                $query = ProductQuery::create(null, $criteria);
                if ($distinct) {
                    $query->distinct();
                }

                return $query
                    ->filterByTag($this)
                    ->count($con);
            }
        } else {
            return count($this->collProducts);
        }
    }

    /**
     * Associate a Product object to this object
     * through the product_tag cross reference table.
     *
     * @param  Product $product The ProductTag object to relate
     * @return Tag The current object (for fluent API support)
     */
    public function addProduct(Product $product)
    {
        if ($this->collProducts === null) {
            $this->initProducts();
        }

        if (!$this->collProducts->contains($product)) { // only add it if the **same** object is not already associated
            $this->doAddProduct($product);
            $this->collProducts[] = $product;

            if ($this->productsScheduledForDeletion and $this->productsScheduledForDeletion->contains($product)) {
                $this->productsScheduledForDeletion->remove($this->productsScheduledForDeletion->search($product));
            }
        }

        return $this;
    }

    /**
     * @param	Product $product The product object to add.
     */
    protected function doAddProduct(Product $product)
    {
        // set the back reference to this object directly as using provided method either results
        // in endless loop or in multiple relations
        if (!$product->getTags()->contains($this)) { $productTag = new ProductTag();
            $productTag->setProduct($product);
            $this->addProductTag($productTag);

            $foreignCollection = $product->getTags();
            $foreignCollection[] = $this;
        }
    }

    /**
     * Remove a Product object to this object
     * through the product_tag cross reference table.
     *
     * @param Product $product The ProductTag object to relate
     * @return Tag The current object (for fluent API support)
     */
    public function removeProduct(Product $product)
    {
        if ($this->getProducts()->contains($product)) {
            $this->collProducts->remove($this->collProducts->search($product));
            if (null === $this->productsScheduledForDeletion) {
                $this->productsScheduledForDeletion = clone $this->collProducts;
                $this->productsScheduledForDeletion->clear();
            }
            $this->productsScheduledForDeletion[]= $product;
        }

        return $this;
    }

    /**
     * Clears the current object and sets all attributes to their default values
     */
    public function clear()
    {
        $this->id = null;
        $this->type_id = null;
        $this->parent_id = null;
        $this->active = null;
        $this->created_at = null;
        $this->updated_at = null;
        $this->alreadyInSave = false;
        $this->alreadyInValidation = false;
        $this->alreadyInClearAllReferencesDeep = false;
        $this->clearAllReferences();
        $this->applyDefaultValues();
        $this->resetModified();
        $this->setNew(true);
        $this->setDeleted(false);
    }

    /**
     * Resets all references to other model objects or collections of model objects.
     *
     * This method is a user-space workaround for PHP's inability to garbage collect
     * objects with circular references (even in PHP 5.3). This is currently necessary
     * when using Propel in certain daemon or large-volume/high-memory operations.
     *
     * @param boolean $deep Whether to also clear the references on all referrer objects.
     */
    public function clearAllReferences($deep = false)
    {
        if ($deep && !$this->alreadyInClearAllReferencesDeep) {
            $this->alreadyInClearAllReferencesDeep = true;
            if ($this->collOfferTags) {
                foreach ($this->collOfferTags as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collProductTags) {
                foreach ($this->collProductTags as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collTagsRelatedById) {
                foreach ($this->collTagsRelatedById as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collTagI18ns) {
                foreach ($this->collTagI18ns as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collOffers) {
                foreach ($this->collOffers as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collProducts) {
                foreach ($this->collProducts as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->aTagRelatedByParentId instanceof Persistent) {
              $this->aTagRelatedByParentId->clearAllReferences($deep);
            }
            if ($this->aTagType instanceof Persistent) {
              $this->aTagType->clearAllReferences($deep);
            }

            $this->alreadyInClearAllReferencesDeep = false;
        } // if ($deep)

        // i18n behavior
        $this->currentLocale = 'en_US';
        $this->currentTranslations = null;

        if ($this->collOfferTags instanceof PropelCollection) {
            $this->collOfferTags->clearIterator();
        }
        $this->collOfferTags = null;
        if ($this->collProductTags instanceof PropelCollection) {
            $this->collProductTags->clearIterator();
        }
        $this->collProductTags = null;
        if ($this->collTagsRelatedById instanceof PropelCollection) {
            $this->collTagsRelatedById->clearIterator();
        }
        $this->collTagsRelatedById = null;
        if ($this->collTagI18ns instanceof PropelCollection) {
            $this->collTagI18ns->clearIterator();
        }
        $this->collTagI18ns = null;
        if ($this->collOffers instanceof PropelCollection) {
            $this->collOffers->clearIterator();
        }
        $this->collOffers = null;
        if ($this->collProducts instanceof PropelCollection) {
            $this->collProducts->clearIterator();
        }
        $this->collProducts = null;
        $this->aTagRelatedByParentId = null;
        $this->aTagType = null;
    }

    /**
     * return the string representation of this object
     *
     * @return string
     */
    public function __toString()
    {
        return (string) $this->exportTo(TagPeer::DEFAULT_STRING_FORMAT);
    }

    /**
     * return true is the object is in saving state
     *
     * @return boolean
     */
    public function isAlreadyInSave()
    {
        return $this->alreadyInSave;
    }

    // timestampable behavior

    /**
     * Mark the current object so that the update date doesn't get updated during next save
     *
     * @return     Tag The current object (for fluent API support)
     */
    public function keepUpdateDateUnchanged()
    {
        $this->modifiedColumns[] = TagPeer::UPDATED_AT;

        return $this;
    }

    // i18n behavior

    /**
     * Sets the locale for translations
     *
     * @param     string $locale Locale to use for the translation, e.g. 'fr_FR'
     *
     * @return    Tag The current object (for fluent API support)
     */
    public function setLocale($locale = 'en_US')
    {
        $this->currentLocale = $locale;

        return $this;
    }

    /**
     * Gets the locale for translations
     *
     * @return    string $locale Locale to use for the translation, e.g. 'fr_FR'
     */
    public function getLocale()
    {
        return $this->currentLocale;
    }

    /**
     * Returns the current translation for a given locale
     *
     * @param     string $locale Locale to use for the translation, e.g. 'fr_FR'
     * @param     PropelPDO $con an optional connection object
     *
     * @return TagI18n */
    public function getTranslation($locale = 'en_US', PropelPDO $con = null)
    {
        if (!isset($this->currentTranslations[$locale])) {
            if (null !== $this->collTagI18ns) {
                foreach ($this->collTagI18ns as $translation) {
                    if ($translation->getLocale() == $locale) {
                        $this->currentTranslations[$locale] = $translation;

                        return $translation;
                    }
                }
            }
            if ($this->isNew()) {
                $translation = new TagI18n();
                $translation->setLocale($locale);
            } else {
                $translation = TagI18nQuery::create()
                    ->filterByPrimaryKey(array($this->getPrimaryKey(), $locale))
                    ->findOneOrCreate($con);
                $this->currentTranslations[$locale] = $translation;
            }
            $this->addTagI18n($translation);
        }

        return $this->currentTranslations[$locale];
    }

    /**
     * Remove the translation for a given locale
     *
     * @param     string $locale Locale to use for the translation, e.g. 'fr_FR'
     * @param     PropelPDO $con an optional connection object
     *
     * @return    Tag The current object (for fluent API support)
     */
    public function removeTranslation($locale = 'en_US', PropelPDO $con = null)
    {
        if (!$this->isNew()) {
            TagI18nQuery::create()
                ->filterByPrimaryKey(array($this->getPrimaryKey(), $locale))
                ->delete($con);
        }
        if (isset($this->currentTranslations[$locale])) {
            unset($this->currentTranslations[$locale]);
        }
        foreach ($this->collTagI18ns as $key => $translation) {
            if ($translation->getLocale() == $locale) {
                unset($this->collTagI18ns[$key]);
                break;
            }
        }

        return $this;
    }

    /**
     * Returns the current translation
     *
     * @param     PropelPDO $con an optional connection object
     *
     * @return TagI18n */
    public function getCurrentTranslation(PropelPDO $con = null)
    {
        return $this->getTranslation($this->getLocale(), $con);
    }


        /**
         * Get the [name] column value.
         *
         * @return string
         */
        public function getName()
        {
        return $this->getCurrentTranslation()->getName();
    }


        /**
         * Set the value of [name] column.
         *
         * @param  string $v new value
         * @return TagI18n The current object (for fluent API support)
         */
        public function setName($v)
        {    $this->getCurrentTranslation()->setName($v);

        return $this;
    }

}
