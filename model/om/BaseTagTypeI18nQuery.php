<?php


/**
 * Base class that represents a query for the 'cs_tag_type_i18n' table.
 *
 *
 *
 * @method TagTypeI18nQuery orderById($order = Criteria::ASC) Order by the id column
 * @method TagTypeI18nQuery orderByLocale($order = Criteria::ASC) Order by the locale column
 * @method TagTypeI18nQuery orderByName($order = Criteria::ASC) Order by the name column
 *
 * @method TagTypeI18nQuery groupById() Group by the id column
 * @method TagTypeI18nQuery groupByLocale() Group by the locale column
 * @method TagTypeI18nQuery groupByName() Group by the name column
 *
 * @method TagTypeI18nQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method TagTypeI18nQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method TagTypeI18nQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method TagTypeI18nQuery leftJoinTagType($relationAlias = null) Adds a LEFT JOIN clause to the query using the TagType relation
 * @method TagTypeI18nQuery rightJoinTagType($relationAlias = null) Adds a RIGHT JOIN clause to the query using the TagType relation
 * @method TagTypeI18nQuery innerJoinTagType($relationAlias = null) Adds a INNER JOIN clause to the query using the TagType relation
 *
 * @method TagTypeI18n findOne(PropelPDO $con = null) Return the first TagTypeI18n matching the query
 * @method TagTypeI18n findOneOrCreate(PropelPDO $con = null) Return the first TagTypeI18n matching the query, or a new TagTypeI18n object populated from the query conditions when no match is found
 *
 * @method TagTypeI18n findOneById(int $id) Return the first TagTypeI18n filtered by the id column
 * @method TagTypeI18n findOneByLocale(string $locale) Return the first TagTypeI18n filtered by the locale column
 * @method TagTypeI18n findOneByName(string $name) Return the first TagTypeI18n filtered by the name column
 *
 * @method array findById(int $id) Return TagTypeI18n objects filtered by the id column
 * @method array findByLocale(string $locale) Return TagTypeI18n objects filtered by the locale column
 * @method array findByName(string $name) Return TagTypeI18n objects filtered by the name column
 *
 * @package    propel.generator.model.om
 */
abstract class BaseTagTypeI18nQuery extends ModelCriteria
{
    /**
     * Initializes internal state of BaseTagTypeI18nQuery object.
     *
     * @param     string $dbName The dabase name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = null, $modelName = null, $modelAlias = null)
    {
        if (null === $dbName) {
            $dbName = 'codeshop';
        }
        if (null === $modelName) {
            $modelName = 'TagTypeI18n';
        }
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new TagTypeI18nQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param   TagTypeI18nQuery|Criteria $criteria Optional Criteria to build the query from
     *
     * @return TagTypeI18nQuery
     */
    public static function create($modelAlias = null, $criteria = null)
    {
        if ($criteria instanceof TagTypeI18nQuery) {
            return $criteria;
        }
        $query = new TagTypeI18nQuery(null, null, $modelAlias);

        if ($criteria instanceof Criteria) {
            $query->mergeWith($criteria);
        }

        return $query;
    }

    /**
     * Find object by primary key.
     * Propel uses the instance pool to skip the database if the object exists.
     * Go fast if the query is untouched.
     *
     * <code>
     * $obj = $c->findPk(array(12, 34), $con);
     * </code>
     *
     * @param array $key Primary key to use for the query
                         A Primary key composition: [$id, $locale]
     * @param     PropelPDO $con an optional connection object
     *
     * @return   TagTypeI18n|TagTypeI18n[]|mixed the result, formatted by the current formatter
     */
    public function findPk($key, $con = null)
    {
        if ($key === null) {
            return null;
        }
        if ((null !== ($obj = TagTypeI18nPeer::getInstanceFromPool(serialize(array((string) $key[0], (string) $key[1]))))) && !$this->formatter) {
            // the object is already in the instance pool
            return $obj;
        }
        if ($con === null) {
            $con = Propel::getConnection(TagTypeI18nPeer::DATABASE_NAME, Propel::CONNECTION_READ);
        }
        $this->basePreSelect($con);
        if ($this->formatter || $this->modelAlias || $this->with || $this->select
         || $this->selectColumns || $this->asColumns || $this->selectModifiers
         || $this->map || $this->having || $this->joins) {
            return $this->findPkComplex($key, $con);
        } else {
            return $this->findPkSimple($key, $con);
        }
    }

    /**
     * Find object by primary key using raw SQL to go fast.
     * Bypass doSelect() and the object formatter by using generated code.
     *
     * @param     mixed $key Primary key to use for the query
     * @param     PropelPDO $con A connection object
     *
     * @return                 TagTypeI18n A model object, or null if the key is not found
     * @throws PropelException
     */
    protected function findPkSimple($key, $con)
    {
        $sql = 'SELECT [id], [locale], [name] FROM [cs_tag_type_i18n] WHERE [id] = :p0 AND [locale] = :p1';
        try {
            $stmt = $con->prepare($sql);
            $stmt->bindValue(':p0', $key[0], PDO::PARAM_INT);
            $stmt->bindValue(':p1', $key[1], PDO::PARAM_STR);
            $stmt->execute();
        } catch (Exception $e) {
            Propel::log($e->getMessage(), Propel::LOG_ERR);
            throw new PropelException(sprintf('Unable to execute SELECT statement [%s]', $sql), $e);
        }
        $obj = null;
        if ($row = $stmt->fetch(PDO::FETCH_NUM)) {
            $obj = new TagTypeI18n();
            $obj->hydrate($row);
            TagTypeI18nPeer::addInstanceToPool($obj, serialize(array((string) $key[0], (string) $key[1])));
        }
        $stmt->closeCursor();

        return $obj;
    }

    /**
     * Find object by primary key.
     *
     * @param     mixed $key Primary key to use for the query
     * @param     PropelPDO $con A connection object
     *
     * @return TagTypeI18n|TagTypeI18n[]|mixed the result, formatted by the current formatter
     */
    protected function findPkComplex($key, $con)
    {
        // As the query uses a PK condition, no limit(1) is necessary.
        $criteria = $this->isKeepQuery() ? clone $this : $this;
        $stmt = $criteria
            ->filterByPrimaryKey($key)
            ->doSelect($con);

        return $criteria->getFormatter()->init($criteria)->formatOne($stmt);
    }

    /**
     * Find objects by primary key
     * <code>
     * $objs = $c->findPks(array(array(12, 56), array(832, 123), array(123, 456)), $con);
     * </code>
     * @param     array $keys Primary keys to use for the query
     * @param     PropelPDO $con an optional connection object
     *
     * @return PropelObjectCollection|TagTypeI18n[]|mixed the list of results, formatted by the current formatter
     */
    public function findPks($keys, $con = null)
    {
        if ($con === null) {
            $con = Propel::getConnection($this->getDbName(), Propel::CONNECTION_READ);
        }
        $this->basePreSelect($con);
        $criteria = $this->isKeepQuery() ? clone $this : $this;
        $stmt = $criteria
            ->filterByPrimaryKeys($keys)
            ->doSelect($con);

        return $criteria->getFormatter()->init($criteria)->format($stmt);
    }

    /**
     * Filter the query by primary key
     *
     * @param     mixed $key Primary key to use for the query
     *
     * @return TagTypeI18nQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {
        $this->addUsingAlias(TagTypeI18nPeer::ID, $key[0], Criteria::EQUAL);
        $this->addUsingAlias(TagTypeI18nPeer::LOCALE, $key[1], Criteria::EQUAL);

        return $this;
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return TagTypeI18nQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {
        if (empty($keys)) {
            return $this->add(null, '1<>1', Criteria::CUSTOM);
        }
        foreach ($keys as $key) {
            $cton0 = $this->getNewCriterion(TagTypeI18nPeer::ID, $key[0], Criteria::EQUAL);
            $cton1 = $this->getNewCriterion(TagTypeI18nPeer::LOCALE, $key[1], Criteria::EQUAL);
            $cton0->addAnd($cton1);
            $this->addOr($cton0);
        }

        return $this;
    }

    /**
     * Filter the query on the id column
     *
     * Example usage:
     * <code>
     * $query->filterById(1234); // WHERE id = 1234
     * $query->filterById(array(12, 34)); // WHERE id IN (12, 34)
     * $query->filterById(array('min' => 12)); // WHERE id >= 12
     * $query->filterById(array('max' => 12)); // WHERE id <= 12
     * </code>
     *
     * @see       filterByTagType()
     *
     * @param     mixed $id The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return TagTypeI18nQuery The current query, for fluid interface
     */
    public function filterById($id = null, $comparison = null)
    {
        if (is_array($id)) {
            $useMinMax = false;
            if (isset($id['min'])) {
                $this->addUsingAlias(TagTypeI18nPeer::ID, $id['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($id['max'])) {
                $this->addUsingAlias(TagTypeI18nPeer::ID, $id['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(TagTypeI18nPeer::ID, $id, $comparison);
    }

    /**
     * Filter the query on the locale column
     *
     * Example usage:
     * <code>
     * $query->filterByLocale('fooValue');   // WHERE locale = 'fooValue'
     * $query->filterByLocale('%fooValue%'); // WHERE locale LIKE '%fooValue%'
     * </code>
     *
     * @param     string $locale The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return TagTypeI18nQuery The current query, for fluid interface
     */
    public function filterByLocale($locale = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($locale)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $locale)) {
                $locale = str_replace('*', '%', $locale);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(TagTypeI18nPeer::LOCALE, $locale, $comparison);
    }

    /**
     * Filter the query on the name column
     *
     * Example usage:
     * <code>
     * $query->filterByName('fooValue');   // WHERE name = 'fooValue'
     * $query->filterByName('%fooValue%'); // WHERE name LIKE '%fooValue%'
     * </code>
     *
     * @param     string $name The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return TagTypeI18nQuery The current query, for fluid interface
     */
    public function filterByName($name = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($name)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $name)) {
                $name = str_replace('*', '%', $name);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(TagTypeI18nPeer::NAME, $name, $comparison);
    }

    /**
     * Filter the query by a related TagType object
     *
     * @param   TagType|PropelObjectCollection $tagType The related object(s) to use as filter
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return                 TagTypeI18nQuery The current query, for fluid interface
     * @throws PropelException - if the provided filter is invalid.
     */
    public function filterByTagType($tagType, $comparison = null)
    {
        if ($tagType instanceof TagType) {
            return $this
                ->addUsingAlias(TagTypeI18nPeer::ID, $tagType->getId(), $comparison);
        } elseif ($tagType instanceof PropelObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(TagTypeI18nPeer::ID, $tagType->toKeyValue('PrimaryKey', 'Id'), $comparison);
        } else {
            throw new PropelException('filterByTagType() only accepts arguments of type TagType or PropelCollection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the TagType relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return TagTypeI18nQuery The current query, for fluid interface
     */
    public function joinTagType($relationAlias = null, $joinType = 'LEFT JOIN')
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('TagType');

        // create a ModelJoin object for this join
        $join = new ModelJoin();
        $join->setJoinType($joinType);
        $join->setRelationMap($relationMap, $this->useAliasInSQL ? $this->getModelAlias() : null, $relationAlias);
        if ($previousJoin = $this->getPreviousJoin()) {
            $join->setPreviousJoin($previousJoin);
        }

        // add the ModelJoin to the current object
        if ($relationAlias) {
            $this->addAlias($relationAlias, $relationMap->getRightTable()->getName());
            $this->addJoinObject($join, $relationAlias);
        } else {
            $this->addJoinObject($join, 'TagType');
        }

        return $this;
    }

    /**
     * Use the TagType relation TagType object
     *
     * @see       useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return   TagTypeQuery A secondary query class using the current class as primary query
     */
    public function useTagTypeQuery($relationAlias = null, $joinType = 'LEFT JOIN')
    {
        return $this
            ->joinTagType($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'TagType', 'TagTypeQuery');
    }

    /**
     * Exclude object from result
     *
     * @param   TagTypeI18n $tagTypeI18n Object to remove from the list of results
     *
     * @return TagTypeI18nQuery The current query, for fluid interface
     */
    public function prune($tagTypeI18n = null)
    {
        if ($tagTypeI18n) {
            $this->addCond('pruneCond0', $this->getAliasedColName(TagTypeI18nPeer::ID), $tagTypeI18n->getId(), Criteria::NOT_EQUAL);
            $this->addCond('pruneCond1', $this->getAliasedColName(TagTypeI18nPeer::LOCALE), $tagTypeI18n->getLocale(), Criteria::NOT_EQUAL);
            $this->combine(array('pruneCond0', 'pruneCond1'), Criteria::LOGICAL_OR);
        }

        return $this;
    }

}
