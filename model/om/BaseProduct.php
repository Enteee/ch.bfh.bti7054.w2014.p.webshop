<?php


/**
 * Base class that represents a row from the 'product' table.
 *
 *
 *
 * @package    propel.generator.model.om
 */
abstract class BaseProduct extends BaseObject implements Persistent
{
    /**
     * Peer class name
     */
    const PEER = 'ProductPeer';

    /**
     * The Peer class.
     * Instance provides a convenient way of calling static methods on a class
     * that calling code may not be able to identify.
     * @var        ProductPeer
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
     * The value for the avg_rating field.
     * @var        int
     */
    protected $avg_rating;

    /**
     * @var        PropelObjectCollection|Review[] Collection to store aggregation of Review objects.
     */
    protected $collReviews;
    protected $collReviewsPartial;

    /**
     * @var        PropelObjectCollection|Offer[] Collection to store aggregation of Offer objects.
     */
    protected $collOffers;
    protected $collOffersPartial;

    /**
     * @var        PropelObjectCollection|ProductTag[] Collection to store aggregation of ProductTag objects.
     */
    protected $collProductTags;
    protected $collProductTagsPartial;

    /**
     * @var        PropelObjectCollection|ProductI18n[] Collection to store aggregation of ProductI18n objects.
     */
    protected $collProductI18ns;
    protected $collProductI18nsPartial;

    /**
     * @var        PropelObjectCollection|Tag[] Collection to store aggregation of Tag objects.
     */
    protected $collTags;

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
     * @var        array[ProductI18n]
     */
    protected $currentTranslations;

    /**
     * An array of objects scheduled for deletion.
     * @var		PropelObjectCollection
     */
    protected $tagsScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var		PropelObjectCollection
     */
    protected $reviewsScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var		PropelObjectCollection
     */
    protected $offersScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var		PropelObjectCollection
     */
    protected $productTagsScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var		PropelObjectCollection
     */
    protected $productI18nsScheduledForDeletion = null;

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
     * Initializes internal state of BaseProduct object.
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
     * Get the [avg_rating] column value.
     *
     * @return int
     */
    public function getAvgRating()
    {

        return $this->avg_rating;
    }

    /**
     * Set the value of [id] column.
     *
     * @param  int $v new value
     * @return Product The current object (for fluent API support)
     */
    public function setId($v)
    {
        if ($v !== null && is_numeric($v)) {
            $v = (int) $v;
        }

        if ($this->id !== $v) {
            $this->id = $v;
            $this->modifiedColumns[] = ProductPeer::ID;
        }


        return $this;
    } // setId()

    /**
     * Sets the value of the [active] column.
     * Non-boolean arguments are converted using the following rules:
     *   * 1, '1', 'true',  'on',  and 'yes' are converted to boolean true
     *   * 0, '0', 'false', 'off', and 'no'  are converted to boolean false
     * Check on string values is case insensitive (so 'FaLsE' is seen as 'false').
     *
     * @param boolean|integer|string $v The new value
     * @return Product The current object (for fluent API support)
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
            $this->modifiedColumns[] = ProductPeer::ACTIVE;
        }


        return $this;
    } // setActive()

    /**
     * Sets the value of [created_at] column to a normalized version of the date/time value specified.
     *
     * @param mixed $v string, integer (timestamp), or DateTime value.
     *               Empty strings are treated as null.
     * @return Product The current object (for fluent API support)
     */
    public function setCreatedAt($v)
    {
        $dt = PropelDateTime::newInstance($v, null, 'DateTime');
        if ($this->created_at !== null || $dt !== null) {
            $currentDateAsString = ($this->created_at !== null && $tmpDt = new DateTime($this->created_at)) ? $tmpDt->format('Y-m-d H:i:s') : null;
            $newDateAsString = $dt ? $dt->format('Y-m-d H:i:s') : null;
            if ($currentDateAsString !== $newDateAsString) {
                $this->created_at = $newDateAsString;
                $this->modifiedColumns[] = ProductPeer::CREATED_AT;
            }
        } // if either are not null


        return $this;
    } // setCreatedAt()

    /**
     * Sets the value of [updated_at] column to a normalized version of the date/time value specified.
     *
     * @param mixed $v string, integer (timestamp), or DateTime value.
     *               Empty strings are treated as null.
     * @return Product The current object (for fluent API support)
     */
    public function setUpdatedAt($v)
    {
        $dt = PropelDateTime::newInstance($v, null, 'DateTime');
        if ($this->updated_at !== null || $dt !== null) {
            $currentDateAsString = ($this->updated_at !== null && $tmpDt = new DateTime($this->updated_at)) ? $tmpDt->format('Y-m-d H:i:s') : null;
            $newDateAsString = $dt ? $dt->format('Y-m-d H:i:s') : null;
            if ($currentDateAsString !== $newDateAsString) {
                $this->updated_at = $newDateAsString;
                $this->modifiedColumns[] = ProductPeer::UPDATED_AT;
            }
        } // if either are not null


        return $this;
    } // setUpdatedAt()

    /**
     * Set the value of [avg_rating] column.
     *
     * @param  int $v new value
     * @return Product The current object (for fluent API support)
     */
    public function setAvgRating($v)
    {
        if ($v !== null && is_numeric($v)) {
            $v = (int) $v;
        }

        if ($this->avg_rating !== $v) {
            $this->avg_rating = $v;
            $this->modifiedColumns[] = ProductPeer::AVG_RATING;
        }


        return $this;
    } // setAvgRating()

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
            $this->active = ($row[$startcol + 1] !== null) ? (boolean) $row[$startcol + 1] : null;
            $this->created_at = ($row[$startcol + 2] !== null) ? (string) $row[$startcol + 2] : null;
            $this->updated_at = ($row[$startcol + 3] !== null) ? (string) $row[$startcol + 3] : null;
            $this->avg_rating = ($row[$startcol + 4] !== null) ? (int) $row[$startcol + 4] : null;
            $this->resetModified();

            $this->setNew(false);

            if ($rehydrate) {
                $this->ensureConsistency();
            }
            $this->postHydrate($row, $startcol, $rehydrate);

            return $startcol + 5; // 5 = ProductPeer::NUM_HYDRATE_COLUMNS.

        } catch (Exception $e) {
            throw new PropelException("Error populating Product object", $e);
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
            $con = Propel::getConnection(ProductPeer::DATABASE_NAME, Propel::CONNECTION_READ);
        }

        // We don't need to alter the object instance pool; we're just modifying this instance
        // already in the pool.

        $stmt = ProductPeer::doSelectStmt($this->buildPkeyCriteria(), $con);
        $row = $stmt->fetch(PDO::FETCH_NUM);
        $stmt->closeCursor();
        if (!$row) {
            throw new PropelException('Cannot find matching row in the database to reload object values.');
        }
        $this->hydrate($row, 0, true); // rehydrate

        if ($deep) {  // also de-associate any related objects?

            $this->collReviews = null;

            $this->collOffers = null;

            $this->collProductTags = null;

            $this->collProductI18ns = null;

            $this->collTags = null;
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
            $con = Propel::getConnection(ProductPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
        }

        $con->beginTransaction();
        try {
            $deleteQuery = ProductQuery::create()
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
            $con = Propel::getConnection(ProductPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
        }

        $con->beginTransaction();
        $isInsert = $this->isNew();
        try {
            $ret = $this->preSave($con);
            if ($isInsert) {
                $ret = $ret && $this->preInsert($con);
                // timestampable behavior
                if (!$this->isColumnModified(ProductPeer::CREATED_AT)) {
                    $this->setCreatedAt(time());
                }
                if (!$this->isColumnModified(ProductPeer::UPDATED_AT)) {
                    $this->setUpdatedAt(time());
                }
            } else {
                $ret = $ret && $this->preUpdate($con);
                // timestampable behavior
                if ($this->isModified() && !$this->isColumnModified(ProductPeer::UPDATED_AT)) {
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
                // aggregate_column behavior
                if (null !== $this->collReviews) {
                    $this->setAvgRating($this->computeAvgRating($con));
                    if ($this->isModified()) {
                        $this->save($con);
                    }
                }

                ProductPeer::addInstanceToPool($this);
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

            if ($this->tagsScheduledForDeletion !== null) {
                if (!$this->tagsScheduledForDeletion->isEmpty()) {
                    $pks = array();
                    $pk = $this->getPrimaryKey();
                    foreach ($this->tagsScheduledForDeletion->getPrimaryKeys(false) as $remotePk) {
                        $pks[] = array($pk, $remotePk);
                    }
                    ProductTagQuery::create()
                        ->filterByPrimaryKeys($pks)
                        ->delete($con);
                    $this->tagsScheduledForDeletion = null;
                }

                foreach ($this->getTags() as $tag) {
                    if ($tag->isModified()) {
                        $tag->save($con);
                    }
                }
            } elseif ($this->collTags) {
                foreach ($this->collTags as $tag) {
                    if ($tag->isModified()) {
                        $tag->save($con);
                    }
                }
            }

            if ($this->reviewsScheduledForDeletion !== null) {
                if (!$this->reviewsScheduledForDeletion->isEmpty()) {
                    ReviewQuery::create()
                        ->filterByPrimaryKeys($this->reviewsScheduledForDeletion->getPrimaryKeys(false))
                        ->delete($con);
                    $this->reviewsScheduledForDeletion = null;
                }
            }

            if ($this->collReviews !== null) {
                foreach ($this->collReviews as $referrerFK) {
                    if (!$referrerFK->isDeleted() && ($referrerFK->isNew() || $referrerFK->isModified())) {
                        $affectedRows += $referrerFK->save($con);
                    }
                }
            }

            if ($this->offersScheduledForDeletion !== null) {
                if (!$this->offersScheduledForDeletion->isEmpty()) {
                    OfferQuery::create()
                        ->filterByPrimaryKeys($this->offersScheduledForDeletion->getPrimaryKeys(false))
                        ->delete($con);
                    $this->offersScheduledForDeletion = null;
                }
            }

            if ($this->collOffers !== null) {
                foreach ($this->collOffers as $referrerFK) {
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

            if ($this->productI18nsScheduledForDeletion !== null) {
                if (!$this->productI18nsScheduledForDeletion->isEmpty()) {
                    ProductI18nQuery::create()
                        ->filterByPrimaryKeys($this->productI18nsScheduledForDeletion->getPrimaryKeys(false))
                        ->delete($con);
                    $this->productI18nsScheduledForDeletion = null;
                }
            }

            if ($this->collProductI18ns !== null) {
                foreach ($this->collProductI18ns as $referrerFK) {
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

        $this->modifiedColumns[] = ProductPeer::ID;
        if (null !== $this->id) {
            throw new PropelException('Cannot insert a value for auto-increment primary key (' . ProductPeer::ID . ')');
        }

         // check the columns in natural order for more readable SQL queries
        if ($this->isColumnModified(ProductPeer::ID)) {
            $modifiedColumns[':p' . $index++]  = '`id`';
        }
        if ($this->isColumnModified(ProductPeer::ACTIVE)) {
            $modifiedColumns[':p' . $index++]  = '`active`';
        }
        if ($this->isColumnModified(ProductPeer::CREATED_AT)) {
            $modifiedColumns[':p' . $index++]  = '`created_at`';
        }
        if ($this->isColumnModified(ProductPeer::UPDATED_AT)) {
            $modifiedColumns[':p' . $index++]  = '`updated_at`';
        }
        if ($this->isColumnModified(ProductPeer::AVG_RATING)) {
            $modifiedColumns[':p' . $index++]  = '`avg_rating`';
        }

        $sql = sprintf(
            'INSERT INTO `product` (%s) VALUES (%s)',
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
                    case '`active`':
                        $stmt->bindValue($identifier, (int) $this->active, PDO::PARAM_INT);
                        break;
                    case '`created_at`':
                        $stmt->bindValue($identifier, $this->created_at, PDO::PARAM_STR);
                        break;
                    case '`updated_at`':
                        $stmt->bindValue($identifier, $this->updated_at, PDO::PARAM_STR);
                        break;
                    case '`avg_rating`':
                        $stmt->bindValue($identifier, $this->avg_rating, PDO::PARAM_INT);
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


            if (($retval = ProductPeer::doValidate($this, $columns)) !== true) {
                $failureMap = array_merge($failureMap, $retval);
            }


                if ($this->collReviews !== null) {
                    foreach ($this->collReviews as $referrerFK) {
                        if (!$referrerFK->validate($columns)) {
                            $failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
                        }
                    }
                }

                if ($this->collOffers !== null) {
                    foreach ($this->collOffers as $referrerFK) {
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

                if ($this->collProductI18ns !== null) {
                    foreach ($this->collProductI18ns as $referrerFK) {
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
        $pos = ProductPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
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
                return $this->getActive();
                break;
            case 2:
                return $this->getCreatedAt();
                break;
            case 3:
                return $this->getUpdatedAt();
                break;
            case 4:
                return $this->getAvgRating();
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
        if (isset($alreadyDumpedObjects['Product'][$this->getPrimaryKey()])) {
            return '*RECURSION*';
        }
        $alreadyDumpedObjects['Product'][$this->getPrimaryKey()] = true;
        $keys = ProductPeer::getFieldNames($keyType);
        $result = array(
            $keys[0] => $this->getId(),
            $keys[1] => $this->getActive(),
            $keys[2] => $this->getCreatedAt(),
            $keys[3] => $this->getUpdatedAt(),
            $keys[4] => $this->getAvgRating(),
        );
        $virtualColumns = $this->virtualColumns;
        foreach ($virtualColumns as $key => $virtualColumn) {
            $result[$key] = $virtualColumn;
        }

        if ($includeForeignObjects) {
            if (null !== $this->collReviews) {
                $result['Reviews'] = $this->collReviews->toArray(null, true, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
            }
            if (null !== $this->collOffers) {
                $result['Offers'] = $this->collOffers->toArray(null, true, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
            }
            if (null !== $this->collProductTags) {
                $result['ProductTags'] = $this->collProductTags->toArray(null, true, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
            }
            if (null !== $this->collProductI18ns) {
                $result['ProductI18ns'] = $this->collProductI18ns->toArray(null, true, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
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
        $pos = ProductPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);

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
                $this->setActive($value);
                break;
            case 2:
                $this->setCreatedAt($value);
                break;
            case 3:
                $this->setUpdatedAt($value);
                break;
            case 4:
                $this->setAvgRating($value);
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
        $keys = ProductPeer::getFieldNames($keyType);

        if (array_key_exists($keys[0], $arr)) $this->setId($arr[$keys[0]]);
        if (array_key_exists($keys[1], $arr)) $this->setActive($arr[$keys[1]]);
        if (array_key_exists($keys[2], $arr)) $this->setCreatedAt($arr[$keys[2]]);
        if (array_key_exists($keys[3], $arr)) $this->setUpdatedAt($arr[$keys[3]]);
        if (array_key_exists($keys[4], $arr)) $this->setAvgRating($arr[$keys[4]]);
    }

    /**
     * Build a Criteria object containing the values of all modified columns in this object.
     *
     * @return Criteria The Criteria object containing all modified values.
     */
    public function buildCriteria()
    {
        $criteria = new Criteria(ProductPeer::DATABASE_NAME);

        if ($this->isColumnModified(ProductPeer::ID)) $criteria->add(ProductPeer::ID, $this->id);
        if ($this->isColumnModified(ProductPeer::ACTIVE)) $criteria->add(ProductPeer::ACTIVE, $this->active);
        if ($this->isColumnModified(ProductPeer::CREATED_AT)) $criteria->add(ProductPeer::CREATED_AT, $this->created_at);
        if ($this->isColumnModified(ProductPeer::UPDATED_AT)) $criteria->add(ProductPeer::UPDATED_AT, $this->updated_at);
        if ($this->isColumnModified(ProductPeer::AVG_RATING)) $criteria->add(ProductPeer::AVG_RATING, $this->avg_rating);

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
        $criteria = new Criteria(ProductPeer::DATABASE_NAME);
        $criteria->add(ProductPeer::ID, $this->id);

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
     * @param object $copyObj An object of Product (or compatible) type.
     * @param boolean $deepCopy Whether to also copy all rows that refer (by fkey) to the current row.
     * @param boolean $makeNew Whether to reset autoincrement PKs and make the object new.
     * @throws PropelException
     */
    public function copyInto($copyObj, $deepCopy = false, $makeNew = true)
    {
        $copyObj->setActive($this->getActive());
        $copyObj->setCreatedAt($this->getCreatedAt());
        $copyObj->setUpdatedAt($this->getUpdatedAt());
        $copyObj->setAvgRating($this->getAvgRating());

        if ($deepCopy && !$this->startCopy) {
            // important: temporarily setNew(false) because this affects the behavior of
            // the getter/setter methods for fkey referrer objects.
            $copyObj->setNew(false);
            // store object hash to prevent cycle
            $this->startCopy = true;

            foreach ($this->getReviews() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addReview($relObj->copy($deepCopy));
                }
            }

            foreach ($this->getOffers() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addOffer($relObj->copy($deepCopy));
                }
            }

            foreach ($this->getProductTags() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addProductTag($relObj->copy($deepCopy));
                }
            }

            foreach ($this->getProductI18ns() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addProductI18n($relObj->copy($deepCopy));
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
     * @return Product Clone of current object.
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
     * @return ProductPeer
     */
    public function getPeer()
    {
        if (self::$peer === null) {
            self::$peer = new ProductPeer();
        }

        return self::$peer;
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
        if ('Review' == $relationName) {
            $this->initReviews();
        }
        if ('Offer' == $relationName) {
            $this->initOffers();
        }
        if ('ProductTag' == $relationName) {
            $this->initProductTags();
        }
        if ('ProductI18n' == $relationName) {
            $this->initProductI18ns();
        }
    }

    /**
     * Clears out the collReviews collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return Product The current object (for fluent API support)
     * @see        addReviews()
     */
    public function clearReviews()
    {
        $this->collReviews = null; // important to set this to null since that means it is uninitialized
        $this->collReviewsPartial = null;

        return $this;
    }

    /**
     * reset is the collReviews collection loaded partially
     *
     * @return void
     */
    public function resetPartialReviews($v = true)
    {
        $this->collReviewsPartial = $v;
    }

    /**
     * Initializes the collReviews collection.
     *
     * By default this just sets the collReviews collection to an empty array (like clearcollReviews());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param boolean $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initReviews($overrideExisting = true)
    {
        if (null !== $this->collReviews && !$overrideExisting) {
            return;
        }
        $this->collReviews = new PropelObjectCollection();
        $this->collReviews->setModel('Review');
    }

    /**
     * Gets an array of Review objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this Product is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param PropelPDO $con optional connection object
     * @return PropelObjectCollection|Review[] List of Review objects
     * @throws PropelException
     */
    public function getReviews($criteria = null, PropelPDO $con = null)
    {
        $partial = $this->collReviewsPartial && !$this->isNew();
        if (null === $this->collReviews || null !== $criteria  || $partial) {
            if ($this->isNew() && null === $this->collReviews) {
                // return empty collection
                $this->initReviews();
            } else {
                $collReviews = ReviewQuery::create(null, $criteria)
                    ->filterByProduct($this)
                    ->find($con);
                if (null !== $criteria) {
                    if (false !== $this->collReviewsPartial && count($collReviews)) {
                      $this->initReviews(false);

                      foreach ($collReviews as $obj) {
                        if (false == $this->collReviews->contains($obj)) {
                          $this->collReviews->append($obj);
                        }
                      }

                      $this->collReviewsPartial = true;
                    }

                    $collReviews->getInternalIterator()->rewind();

                    return $collReviews;
                }

                if ($partial && $this->collReviews) {
                    foreach ($this->collReviews as $obj) {
                        if ($obj->isNew()) {
                            $collReviews[] = $obj;
                        }
                    }
                }

                $this->collReviews = $collReviews;
                $this->collReviewsPartial = false;
            }
        }

        return $this->collReviews;
    }

    /**
     * Sets a collection of Review objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param PropelCollection $reviews A Propel collection.
     * @param PropelPDO $con Optional connection object
     * @return Product The current object (for fluent API support)
     */
    public function setReviews(PropelCollection $reviews, PropelPDO $con = null)
    {
        $reviewsToDelete = $this->getReviews(new Criteria(), $con)->diff($reviews);


        $this->reviewsScheduledForDeletion = $reviewsToDelete;

        foreach ($reviewsToDelete as $reviewRemoved) {
            $reviewRemoved->setProduct(null);
        }

        $this->collReviews = null;
        foreach ($reviews as $review) {
            $this->addReview($review);
        }

        $this->collReviews = $reviews;
        $this->collReviewsPartial = false;

        return $this;
    }

    /**
     * Returns the number of related Review objects.
     *
     * @param Criteria $criteria
     * @param boolean $distinct
     * @param PropelPDO $con
     * @return int             Count of related Review objects.
     * @throws PropelException
     */
    public function countReviews(Criteria $criteria = null, $distinct = false, PropelPDO $con = null)
    {
        $partial = $this->collReviewsPartial && !$this->isNew();
        if (null === $this->collReviews || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collReviews) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getReviews());
            }
            $query = ReviewQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterByProduct($this)
                ->count($con);
        }

        return count($this->collReviews);
    }

    /**
     * Method called to associate a Review object to this object
     * through the Review foreign key attribute.
     *
     * @param    Review $l Review
     * @return Product The current object (for fluent API support)
     */
    public function addReview(Review $l)
    {
        if ($this->collReviews === null) {
            $this->initReviews();
            $this->collReviewsPartial = true;
        }

        if (!in_array($l, $this->collReviews->getArrayCopy(), true)) { // only add it if the **same** object is not already associated
            $this->doAddReview($l);

            if ($this->reviewsScheduledForDeletion and $this->reviewsScheduledForDeletion->contains($l)) {
                $this->reviewsScheduledForDeletion->remove($this->reviewsScheduledForDeletion->search($l));
            }
        }

        return $this;
    }

    /**
     * @param	Review $review The review object to add.
     */
    protected function doAddReview($review)
    {
        $this->collReviews[]= $review;
        $review->setProduct($this);
    }

    /**
     * @param	Review $review The review object to remove.
     * @return Product The current object (for fluent API support)
     */
    public function removeReview($review)
    {
        if ($this->getReviews()->contains($review)) {
            $this->collReviews->remove($this->collReviews->search($review));
            if (null === $this->reviewsScheduledForDeletion) {
                $this->reviewsScheduledForDeletion = clone $this->collReviews;
                $this->reviewsScheduledForDeletion->clear();
            }
            $this->reviewsScheduledForDeletion[]= clone $review;
            $review->setProduct(null);
        }

        return $this;
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Product is new, it will return
     * an empty collection; or if this Product has previously
     * been saved, it will retrieve related Reviews from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Product.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param PropelPDO $con optional connection object
     * @param string $join_behavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return PropelObjectCollection|Review[] List of Review objects
     */
    public function getReviewsJoinUser($criteria = null, $con = null, $join_behavior = Criteria::LEFT_JOIN)
    {
        $query = ReviewQuery::create(null, $criteria);
        $query->joinWith('User', $join_behavior);

        return $this->getReviews($query, $con);
    }

    /**
     * Clears out the collOffers collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return Product The current object (for fluent API support)
     * @see        addOffers()
     */
    public function clearOffers()
    {
        $this->collOffers = null; // important to set this to null since that means it is uninitialized
        $this->collOffersPartial = null;

        return $this;
    }

    /**
     * reset is the collOffers collection loaded partially
     *
     * @return void
     */
    public function resetPartialOffers($v = true)
    {
        $this->collOffersPartial = $v;
    }

    /**
     * Initializes the collOffers collection.
     *
     * By default this just sets the collOffers collection to an empty array (like clearcollOffers());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param boolean $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initOffers($overrideExisting = true)
    {
        if (null !== $this->collOffers && !$overrideExisting) {
            return;
        }
        $this->collOffers = new PropelObjectCollection();
        $this->collOffers->setModel('Offer');
    }

    /**
     * Gets an array of Offer objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this Product is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param PropelPDO $con optional connection object
     * @return PropelObjectCollection|Offer[] List of Offer objects
     * @throws PropelException
     */
    public function getOffers($criteria = null, PropelPDO $con = null)
    {
        $partial = $this->collOffersPartial && !$this->isNew();
        if (null === $this->collOffers || null !== $criteria  || $partial) {
            if ($this->isNew() && null === $this->collOffers) {
                // return empty collection
                $this->initOffers();
            } else {
                $collOffers = OfferQuery::create(null, $criteria)
                    ->filterByProduct($this)
                    ->find($con);
                if (null !== $criteria) {
                    if (false !== $this->collOffersPartial && count($collOffers)) {
                      $this->initOffers(false);

                      foreach ($collOffers as $obj) {
                        if (false == $this->collOffers->contains($obj)) {
                          $this->collOffers->append($obj);
                        }
                      }

                      $this->collOffersPartial = true;
                    }

                    $collOffers->getInternalIterator()->rewind();

                    return $collOffers;
                }

                if ($partial && $this->collOffers) {
                    foreach ($this->collOffers as $obj) {
                        if ($obj->isNew()) {
                            $collOffers[] = $obj;
                        }
                    }
                }

                $this->collOffers = $collOffers;
                $this->collOffersPartial = false;
            }
        }

        return $this->collOffers;
    }

    /**
     * Sets a collection of Offer objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param PropelCollection $offers A Propel collection.
     * @param PropelPDO $con Optional connection object
     * @return Product The current object (for fluent API support)
     */
    public function setOffers(PropelCollection $offers, PropelPDO $con = null)
    {
        $offersToDelete = $this->getOffers(new Criteria(), $con)->diff($offers);


        $this->offersScheduledForDeletion = $offersToDelete;

        foreach ($offersToDelete as $offerRemoved) {
            $offerRemoved->setProduct(null);
        }

        $this->collOffers = null;
        foreach ($offers as $offer) {
            $this->addOffer($offer);
        }

        $this->collOffers = $offers;
        $this->collOffersPartial = false;

        return $this;
    }

    /**
     * Returns the number of related Offer objects.
     *
     * @param Criteria $criteria
     * @param boolean $distinct
     * @param PropelPDO $con
     * @return int             Count of related Offer objects.
     * @throws PropelException
     */
    public function countOffers(Criteria $criteria = null, $distinct = false, PropelPDO $con = null)
    {
        $partial = $this->collOffersPartial && !$this->isNew();
        if (null === $this->collOffers || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collOffers) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getOffers());
            }
            $query = OfferQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterByProduct($this)
                ->count($con);
        }

        return count($this->collOffers);
    }

    /**
     * Method called to associate a Offer object to this object
     * through the Offer foreign key attribute.
     *
     * @param    Offer $l Offer
     * @return Product The current object (for fluent API support)
     */
    public function addOffer(Offer $l)
    {
        if ($this->collOffers === null) {
            $this->initOffers();
            $this->collOffersPartial = true;
        }

        if (!in_array($l, $this->collOffers->getArrayCopy(), true)) { // only add it if the **same** object is not already associated
            $this->doAddOffer($l);

            if ($this->offersScheduledForDeletion and $this->offersScheduledForDeletion->contains($l)) {
                $this->offersScheduledForDeletion->remove($this->offersScheduledForDeletion->search($l));
            }
        }

        return $this;
    }

    /**
     * @param	Offer $offer The offer object to add.
     */
    protected function doAddOffer($offer)
    {
        $this->collOffers[]= $offer;
        $offer->setProduct($this);
    }

    /**
     * @param	Offer $offer The offer object to remove.
     * @return Product The current object (for fluent API support)
     */
    public function removeOffer($offer)
    {
        if ($this->getOffers()->contains($offer)) {
            $this->collOffers->remove($this->collOffers->search($offer));
            if (null === $this->offersScheduledForDeletion) {
                $this->offersScheduledForDeletion = clone $this->collOffers;
                $this->offersScheduledForDeletion->clear();
            }
            $this->offersScheduledForDeletion[]= clone $offer;
            $offer->setProduct(null);
        }

        return $this;
    }

    /**
     * Clears out the collProductTags collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return Product The current object (for fluent API support)
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
     * If this Product is new, it will return
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
                    ->filterByProduct($this)
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
     * @return Product The current object (for fluent API support)
     */
    public function setProductTags(PropelCollection $productTags, PropelPDO $con = null)
    {
        $productTagsToDelete = $this->getProductTags(new Criteria(), $con)->diff($productTags);


        $this->productTagsScheduledForDeletion = $productTagsToDelete;

        foreach ($productTagsToDelete as $productTagRemoved) {
            $productTagRemoved->setProduct(null);
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
                ->filterByProduct($this)
                ->count($con);
        }

        return count($this->collProductTags);
    }

    /**
     * Method called to associate a ProductTag object to this object
     * through the ProductTag foreign key attribute.
     *
     * @param    ProductTag $l ProductTag
     * @return Product The current object (for fluent API support)
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
        $productTag->setProduct($this);
    }

    /**
     * @param	ProductTag $productTag The productTag object to remove.
     * @return Product The current object (for fluent API support)
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
            $productTag->setProduct(null);
        }

        return $this;
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Product is new, it will return
     * an empty collection; or if this Product has previously
     * been saved, it will retrieve related ProductTags from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Product.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param PropelPDO $con optional connection object
     * @param string $join_behavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return PropelObjectCollection|ProductTag[] List of ProductTag objects
     */
    public function getProductTagsJoinTag($criteria = null, $con = null, $join_behavior = Criteria::LEFT_JOIN)
    {
        $query = ProductTagQuery::create(null, $criteria);
        $query->joinWith('Tag', $join_behavior);

        return $this->getProductTags($query, $con);
    }

    /**
     * Clears out the collProductI18ns collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return Product The current object (for fluent API support)
     * @see        addProductI18ns()
     */
    public function clearProductI18ns()
    {
        $this->collProductI18ns = null; // important to set this to null since that means it is uninitialized
        $this->collProductI18nsPartial = null;

        return $this;
    }

    /**
     * reset is the collProductI18ns collection loaded partially
     *
     * @return void
     */
    public function resetPartialProductI18ns($v = true)
    {
        $this->collProductI18nsPartial = $v;
    }

    /**
     * Initializes the collProductI18ns collection.
     *
     * By default this just sets the collProductI18ns collection to an empty array (like clearcollProductI18ns());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param boolean $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initProductI18ns($overrideExisting = true)
    {
        if (null !== $this->collProductI18ns && !$overrideExisting) {
            return;
        }
        $this->collProductI18ns = new PropelObjectCollection();
        $this->collProductI18ns->setModel('ProductI18n');
    }

    /**
     * Gets an array of ProductI18n objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this Product is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param PropelPDO $con optional connection object
     * @return PropelObjectCollection|ProductI18n[] List of ProductI18n objects
     * @throws PropelException
     */
    public function getProductI18ns($criteria = null, PropelPDO $con = null)
    {
        $partial = $this->collProductI18nsPartial && !$this->isNew();
        if (null === $this->collProductI18ns || null !== $criteria  || $partial) {
            if ($this->isNew() && null === $this->collProductI18ns) {
                // return empty collection
                $this->initProductI18ns();
            } else {
                $collProductI18ns = ProductI18nQuery::create(null, $criteria)
                    ->filterByProduct($this)
                    ->find($con);
                if (null !== $criteria) {
                    if (false !== $this->collProductI18nsPartial && count($collProductI18ns)) {
                      $this->initProductI18ns(false);

                      foreach ($collProductI18ns as $obj) {
                        if (false == $this->collProductI18ns->contains($obj)) {
                          $this->collProductI18ns->append($obj);
                        }
                      }

                      $this->collProductI18nsPartial = true;
                    }

                    $collProductI18ns->getInternalIterator()->rewind();

                    return $collProductI18ns;
                }

                if ($partial && $this->collProductI18ns) {
                    foreach ($this->collProductI18ns as $obj) {
                        if ($obj->isNew()) {
                            $collProductI18ns[] = $obj;
                        }
                    }
                }

                $this->collProductI18ns = $collProductI18ns;
                $this->collProductI18nsPartial = false;
            }
        }

        return $this->collProductI18ns;
    }

    /**
     * Sets a collection of ProductI18n objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param PropelCollection $productI18ns A Propel collection.
     * @param PropelPDO $con Optional connection object
     * @return Product The current object (for fluent API support)
     */
    public function setProductI18ns(PropelCollection $productI18ns, PropelPDO $con = null)
    {
        $productI18nsToDelete = $this->getProductI18ns(new Criteria(), $con)->diff($productI18ns);


        //since at least one column in the foreign key is at the same time a PK
        //we can not just set a PK to NULL in the lines below. We have to store
        //a backup of all values, so we are able to manipulate these items based on the onDelete value later.
        $this->productI18nsScheduledForDeletion = clone $productI18nsToDelete;

        foreach ($productI18nsToDelete as $productI18nRemoved) {
            $productI18nRemoved->setProduct(null);
        }

        $this->collProductI18ns = null;
        foreach ($productI18ns as $productI18n) {
            $this->addProductI18n($productI18n);
        }

        $this->collProductI18ns = $productI18ns;
        $this->collProductI18nsPartial = false;

        return $this;
    }

    /**
     * Returns the number of related ProductI18n objects.
     *
     * @param Criteria $criteria
     * @param boolean $distinct
     * @param PropelPDO $con
     * @return int             Count of related ProductI18n objects.
     * @throws PropelException
     */
    public function countProductI18ns(Criteria $criteria = null, $distinct = false, PropelPDO $con = null)
    {
        $partial = $this->collProductI18nsPartial && !$this->isNew();
        if (null === $this->collProductI18ns || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collProductI18ns) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getProductI18ns());
            }
            $query = ProductI18nQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterByProduct($this)
                ->count($con);
        }

        return count($this->collProductI18ns);
    }

    /**
     * Method called to associate a ProductI18n object to this object
     * through the ProductI18n foreign key attribute.
     *
     * @param    ProductI18n $l ProductI18n
     * @return Product The current object (for fluent API support)
     */
    public function addProductI18n(ProductI18n $l)
    {
        if ($l && $locale = $l->getLocale()) {
            $this->setLocale($locale);
            $this->currentTranslations[$locale] = $l;
        }
        if ($this->collProductI18ns === null) {
            $this->initProductI18ns();
            $this->collProductI18nsPartial = true;
        }

        if (!in_array($l, $this->collProductI18ns->getArrayCopy(), true)) { // only add it if the **same** object is not already associated
            $this->doAddProductI18n($l);

            if ($this->productI18nsScheduledForDeletion and $this->productI18nsScheduledForDeletion->contains($l)) {
                $this->productI18nsScheduledForDeletion->remove($this->productI18nsScheduledForDeletion->search($l));
            }
        }

        return $this;
    }

    /**
     * @param	ProductI18n $productI18n The productI18n object to add.
     */
    protected function doAddProductI18n($productI18n)
    {
        $this->collProductI18ns[]= $productI18n;
        $productI18n->setProduct($this);
    }

    /**
     * @param	ProductI18n $productI18n The productI18n object to remove.
     * @return Product The current object (for fluent API support)
     */
    public function removeProductI18n($productI18n)
    {
        if ($this->getProductI18ns()->contains($productI18n)) {
            $this->collProductI18ns->remove($this->collProductI18ns->search($productI18n));
            if (null === $this->productI18nsScheduledForDeletion) {
                $this->productI18nsScheduledForDeletion = clone $this->collProductI18ns;
                $this->productI18nsScheduledForDeletion->clear();
            }
            $this->productI18nsScheduledForDeletion[]= clone $productI18n;
            $productI18n->setProduct(null);
        }

        return $this;
    }

    /**
     * Clears out the collTags collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return Product The current object (for fluent API support)
     * @see        addTags()
     */
    public function clearTags()
    {
        $this->collTags = null; // important to set this to null since that means it is uninitialized
        $this->collTagsPartial = null;

        return $this;
    }

    /**
     * Initializes the collTags collection.
     *
     * By default this just sets the collTags collection to an empty collection (like clearTags());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @return void
     */
    public function initTags()
    {
        $this->collTags = new PropelObjectCollection();
        $this->collTags->setModel('Tag');
    }

    /**
     * Gets a collection of Tag objects related by a many-to-many relationship
     * to the current object by way of the product_tag cross-reference table.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this Product is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param Criteria $criteria Optional query object to filter the query
     * @param PropelPDO $con Optional connection object
     *
     * @return PropelObjectCollection|Tag[] List of Tag objects
     */
    public function getTags($criteria = null, PropelPDO $con = null)
    {
        if (null === $this->collTags || null !== $criteria) {
            if ($this->isNew() && null === $this->collTags) {
                // return empty collection
                $this->initTags();
            } else {
                $collTags = TagQuery::create(null, $criteria)
                    ->filterByProduct($this)
                    ->find($con);
                if (null !== $criteria) {
                    return $collTags;
                }
                $this->collTags = $collTags;
            }
        }

        return $this->collTags;
    }

    /**
     * Sets a collection of Tag objects related by a many-to-many relationship
     * to the current object by way of the product_tag cross-reference table.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param PropelCollection $tags A Propel collection.
     * @param PropelPDO $con Optional connection object
     * @return Product The current object (for fluent API support)
     */
    public function setTags(PropelCollection $tags, PropelPDO $con = null)
    {
        $this->clearTags();
        $currentTags = $this->getTags(null, $con);

        $this->tagsScheduledForDeletion = $currentTags->diff($tags);

        foreach ($tags as $tag) {
            if (!$currentTags->contains($tag)) {
                $this->doAddTag($tag);
            }
        }

        $this->collTags = $tags;

        return $this;
    }

    /**
     * Gets the number of Tag objects related by a many-to-many relationship
     * to the current object by way of the product_tag cross-reference table.
     *
     * @param Criteria $criteria Optional query object to filter the query
     * @param boolean $distinct Set to true to force count distinct
     * @param PropelPDO $con Optional connection object
     *
     * @return int the number of related Tag objects
     */
    public function countTags($criteria = null, $distinct = false, PropelPDO $con = null)
    {
        if (null === $this->collTags || null !== $criteria) {
            if ($this->isNew() && null === $this->collTags) {
                return 0;
            } else {
                $query = TagQuery::create(null, $criteria);
                if ($distinct) {
                    $query->distinct();
                }

                return $query
                    ->filterByProduct($this)
                    ->count($con);
            }
        } else {
            return count($this->collTags);
        }
    }

    /**
     * Associate a Tag object to this object
     * through the product_tag cross reference table.
     *
     * @param  Tag $tag The ProductTag object to relate
     * @return Product The current object (for fluent API support)
     */
    public function addTag(Tag $tag)
    {
        if ($this->collTags === null) {
            $this->initTags();
        }

        if (!$this->collTags->contains($tag)) { // only add it if the **same** object is not already associated
            $this->doAddTag($tag);
            $this->collTags[] = $tag;

            if ($this->tagsScheduledForDeletion and $this->tagsScheduledForDeletion->contains($tag)) {
                $this->tagsScheduledForDeletion->remove($this->tagsScheduledForDeletion->search($tag));
            }
        }

        return $this;
    }

    /**
     * @param	Tag $tag The tag object to add.
     */
    protected function doAddTag(Tag $tag)
    {
        // set the back reference to this object directly as using provided method either results
        // in endless loop or in multiple relations
        if (!$tag->getProducts()->contains($this)) { $productTag = new ProductTag();
            $productTag->setTag($tag);
            $this->addProductTag($productTag);

            $foreignCollection = $tag->getProducts();
            $foreignCollection[] = $this;
        }
    }

    /**
     * Remove a Tag object to this object
     * through the product_tag cross reference table.
     *
     * @param Tag $tag The ProductTag object to relate
     * @return Product The current object (for fluent API support)
     */
    public function removeTag(Tag $tag)
    {
        if ($this->getTags()->contains($tag)) {
            $this->collTags->remove($this->collTags->search($tag));
            if (null === $this->tagsScheduledForDeletion) {
                $this->tagsScheduledForDeletion = clone $this->collTags;
                $this->tagsScheduledForDeletion->clear();
            }
            $this->tagsScheduledForDeletion[]= $tag;
        }

        return $this;
    }

    /**
     * Clears the current object and sets all attributes to their default values
     */
    public function clear()
    {
        $this->id = null;
        $this->active = null;
        $this->created_at = null;
        $this->updated_at = null;
        $this->avg_rating = null;
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
            if ($this->collReviews) {
                foreach ($this->collReviews as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collOffers) {
                foreach ($this->collOffers as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collProductTags) {
                foreach ($this->collProductTags as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collProductI18ns) {
                foreach ($this->collProductI18ns as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collTags) {
                foreach ($this->collTags as $o) {
                    $o->clearAllReferences($deep);
                }
            }

            $this->alreadyInClearAllReferencesDeep = false;
        } // if ($deep)

        // i18n behavior
        $this->currentLocale = 'en_US';
        $this->currentTranslations = null;

        if ($this->collReviews instanceof PropelCollection) {
            $this->collReviews->clearIterator();
        }
        $this->collReviews = null;
        if ($this->collOffers instanceof PropelCollection) {
            $this->collOffers->clearIterator();
        }
        $this->collOffers = null;
        if ($this->collProductTags instanceof PropelCollection) {
            $this->collProductTags->clearIterator();
        }
        $this->collProductTags = null;
        if ($this->collProductI18ns instanceof PropelCollection) {
            $this->collProductI18ns->clearIterator();
        }
        $this->collProductI18ns = null;
        if ($this->collTags instanceof PropelCollection) {
            $this->collTags->clearIterator();
        }
        $this->collTags = null;
    }

    /**
     * return the string representation of this object
     *
     * @return string
     */
    public function __toString()
    {
        return (string) $this->exportTo(ProductPeer::DEFAULT_STRING_FORMAT);
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
     * @return     Product The current object (for fluent API support)
     */
    public function keepUpdateDateUnchanged()
    {
        $this->modifiedColumns[] = ProductPeer::UPDATED_AT;

        return $this;
    }

    // aggregate_column behavior

    /**
     * Computes the value of the aggregate column avg_rating *
     * @param PropelPDO $con A connection object
     *
     * @return mixed The scalar result from the aggregate query
     */
    public function computeAvgRating(PropelPDO $con)
    {
        $stmt = $con->prepare('SELECT AVG(rating) FROM `review` WHERE review.product_id = :p1');
        $stmt->bindValue(':p1', $this->getId());
        $stmt->execute();

        return $stmt->fetchColumn();
    }

    /**
     * Updates the aggregate column avg_rating *
     * @param PropelPDO $con A connection object
     */
    public function updateAvgRating(PropelPDO $con)
    {
        $this->setAvgRating($this->computeAvgRating($con));
        $this->save($con);
    }

    // i18n behavior

    /**
     * Sets the locale for translations
     *
     * @param     string $locale Locale to use for the translation, e.g. 'fr_FR'
     *
     * @return    Product The current object (for fluent API support)
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
     * @return ProductI18n */
    public function getTranslation($locale = 'en_US', PropelPDO $con = null)
    {
        if (!isset($this->currentTranslations[$locale])) {
            if (null !== $this->collProductI18ns) {
                foreach ($this->collProductI18ns as $translation) {
                    if ($translation->getLocale() == $locale) {
                        $this->currentTranslations[$locale] = $translation;

                        return $translation;
                    }
                }
            }
            if ($this->isNew()) {
                $translation = new ProductI18n();
                $translation->setLocale($locale);
            } else {
                $translation = ProductI18nQuery::create()
                    ->filterByPrimaryKey(array($this->getPrimaryKey(), $locale))
                    ->findOneOrCreate($con);
                $this->currentTranslations[$locale] = $translation;
            }
            $this->addProductI18n($translation);
        }

        return $this->currentTranslations[$locale];
    }

    /**
     * Remove the translation for a given locale
     *
     * @param     string $locale Locale to use for the translation, e.g. 'fr_FR'
     * @param     PropelPDO $con an optional connection object
     *
     * @return    Product The current object (for fluent API support)
     */
    public function removeTranslation($locale = 'en_US', PropelPDO $con = null)
    {
        if (!$this->isNew()) {
            ProductI18nQuery::create()
                ->filterByPrimaryKey(array($this->getPrimaryKey(), $locale))
                ->delete($con);
        }
        if (isset($this->currentTranslations[$locale])) {
            unset($this->currentTranslations[$locale]);
        }
        foreach ($this->collProductI18ns as $key => $translation) {
            if ($translation->getLocale() == $locale) {
                unset($this->collProductI18ns[$key]);
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
     * @return ProductI18n */
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
         * @return ProductI18n The current object (for fluent API support)
         */
        public function setName($v)
        {    $this->getCurrentTranslation()->setName($v);

        return $this;
    }


        /**
         * Get the [description] column value.
         *
         * @return string
         */
        public function getDescription()
        {
        return $this->getCurrentTranslation()->getDescription();
    }


        /**
         * Set the value of [description] column.
         *
         * @param  string $v new value
         * @return ProductI18n The current object (for fluent API support)
         */
        public function setDescription($v)
        {    $this->getCurrentTranslation()->setDescription($v);

        return $this;
    }

}
