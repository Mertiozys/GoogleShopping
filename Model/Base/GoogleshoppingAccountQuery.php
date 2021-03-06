<?php

namespace GoogleShopping\Model\Base;

use \Exception;
use \PDO;
use GoogleShopping\Model\GoogleshoppingAccount as ChildGoogleshoppingAccount;
use GoogleShopping\Model\GoogleshoppingAccountQuery as ChildGoogleshoppingAccountQuery;
use GoogleShopping\Model\Map\GoogleshoppingAccountTableMap;
use GoogleShopping\Model\Thelia\Model\Country;
use GoogleShopping\Model\Thelia\Model\Currency;
use Propel\Runtime\Propel;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\ActiveQuery\ModelCriteria;
use Propel\Runtime\ActiveQuery\ModelJoin;
use Propel\Runtime\Collection\Collection;
use Propel\Runtime\Collection\ObjectCollection;
use Propel\Runtime\Connection\ConnectionInterface;
use Propel\Runtime\Exception\PropelException;

/**
 * Base class that represents a query for the 'googleshopping_account' table.
 *
 *
 *
 * @method     ChildGoogleshoppingAccountQuery orderById($order = Criteria::ASC) Order by the id column
 * @method     ChildGoogleshoppingAccountQuery orderByMerchantId($order = Criteria::ASC) Order by the merchant_id column
 * @method     ChildGoogleshoppingAccountQuery orderByDefaultCountryId($order = Criteria::ASC) Order by the default_country_id column
 * @method     ChildGoogleshoppingAccountQuery orderByDefaultCurrencyId($order = Criteria::ASC) Order by the default_currency_id column
 * @method     ChildGoogleshoppingAccountQuery orderByIsDefault($order = Criteria::ASC) Order by the is_default column
 *
 * @method     ChildGoogleshoppingAccountQuery groupById() Group by the id column
 * @method     ChildGoogleshoppingAccountQuery groupByMerchantId() Group by the merchant_id column
 * @method     ChildGoogleshoppingAccountQuery groupByDefaultCountryId() Group by the default_country_id column
 * @method     ChildGoogleshoppingAccountQuery groupByDefaultCurrencyId() Group by the default_currency_id column
 * @method     ChildGoogleshoppingAccountQuery groupByIsDefault() Group by the is_default column
 *
 * @method     ChildGoogleshoppingAccountQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildGoogleshoppingAccountQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildGoogleshoppingAccountQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildGoogleshoppingAccountQuery leftJoinCountry($relationAlias = null) Adds a LEFT JOIN clause to the query using the Country relation
 * @method     ChildGoogleshoppingAccountQuery rightJoinCountry($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Country relation
 * @method     ChildGoogleshoppingAccountQuery innerJoinCountry($relationAlias = null) Adds a INNER JOIN clause to the query using the Country relation
 *
 * @method     ChildGoogleshoppingAccountQuery leftJoinCurrency($relationAlias = null) Adds a LEFT JOIN clause to the query using the Currency relation
 * @method     ChildGoogleshoppingAccountQuery rightJoinCurrency($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Currency relation
 * @method     ChildGoogleshoppingAccountQuery innerJoinCurrency($relationAlias = null) Adds a INNER JOIN clause to the query using the Currency relation
 *
 * @method     ChildGoogleshoppingAccountQuery leftJoinGoogleshoppingProductSynchronisation($relationAlias = null) Adds a LEFT JOIN clause to the query using the GoogleshoppingProductSynchronisation relation
 * @method     ChildGoogleshoppingAccountQuery rightJoinGoogleshoppingProductSynchronisation($relationAlias = null) Adds a RIGHT JOIN clause to the query using the GoogleshoppingProductSynchronisation relation
 * @method     ChildGoogleshoppingAccountQuery innerJoinGoogleshoppingProductSynchronisation($relationAlias = null) Adds a INNER JOIN clause to the query using the GoogleshoppingProductSynchronisation relation
 *
 * @method     ChildGoogleshoppingAccount findOne(ConnectionInterface $con = null) Return the first ChildGoogleshoppingAccount matching the query
 * @method     ChildGoogleshoppingAccount findOneOrCreate(ConnectionInterface $con = null) Return the first ChildGoogleshoppingAccount matching the query, or a new ChildGoogleshoppingAccount object populated from the query conditions when no match is found
 *
 * @method     ChildGoogleshoppingAccount findOneById(int $id) Return the first ChildGoogleshoppingAccount filtered by the id column
 * @method     ChildGoogleshoppingAccount findOneByMerchantId(string $merchant_id) Return the first ChildGoogleshoppingAccount filtered by the merchant_id column
 * @method     ChildGoogleshoppingAccount findOneByDefaultCountryId(int $default_country_id) Return the first ChildGoogleshoppingAccount filtered by the default_country_id column
 * @method     ChildGoogleshoppingAccount findOneByDefaultCurrencyId(int $default_currency_id) Return the first ChildGoogleshoppingAccount filtered by the default_currency_id column
 * @method     ChildGoogleshoppingAccount findOneByIsDefault(boolean $is_default) Return the first ChildGoogleshoppingAccount filtered by the is_default column
 *
 * @method     array findById(int $id) Return ChildGoogleshoppingAccount objects filtered by the id column
 * @method     array findByMerchantId(string $merchant_id) Return ChildGoogleshoppingAccount objects filtered by the merchant_id column
 * @method     array findByDefaultCountryId(int $default_country_id) Return ChildGoogleshoppingAccount objects filtered by the default_country_id column
 * @method     array findByDefaultCurrencyId(int $default_currency_id) Return ChildGoogleshoppingAccount objects filtered by the default_currency_id column
 * @method     array findByIsDefault(boolean $is_default) Return ChildGoogleshoppingAccount objects filtered by the is_default column
 *
 */
abstract class GoogleshoppingAccountQuery extends ModelCriteria
{

    /**
     * Initializes internal state of \GoogleShopping\Model\Base\GoogleshoppingAccountQuery object.
     *
     * @param     string $dbName The database name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'thelia', $modelName = '\\GoogleShopping\\Model\\GoogleshoppingAccount', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildGoogleshoppingAccountQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param     Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildGoogleshoppingAccountQuery
     */
    public static function create($modelAlias = null, $criteria = null)
    {
        if ($criteria instanceof \GoogleShopping\Model\GoogleshoppingAccountQuery) {
            return $criteria;
        }
        $query = new \GoogleShopping\Model\GoogleshoppingAccountQuery();
        if (null !== $modelAlias) {
            $query->setModelAlias($modelAlias);
        }
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
     * $obj  = $c->findPk(12, $con);
     * </code>
     *
     * @param mixed $key Primary key to use for the query
     * @param ConnectionInterface $con an optional connection object
     *
     * @return ChildGoogleshoppingAccount|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, $con = null)
    {
        if ($key === null) {
            return null;
        }
        if ((null !== ($obj = GoogleshoppingAccountTableMap::getInstanceFromPool((string) $key))) && !$this->formatter) {
            // the object is already in the instance pool
            return $obj;
        }
        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(GoogleshoppingAccountTableMap::DATABASE_NAME);
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
     * @param     ConnectionInterface $con A connection object
     *
     * @return   ChildGoogleshoppingAccount A model object, or null if the key is not found
     */
    protected function findPkSimple($key, $con)
    {
        $sql = 'SELECT ID, MERCHANT_ID, DEFAULT_COUNTRY_ID, DEFAULT_CURRENCY_ID, IS_DEFAULT FROM googleshopping_account WHERE ID = :p0';
        try {
            $stmt = $con->prepare($sql);
            $stmt->bindValue(':p0', $key, PDO::PARAM_INT);
            $stmt->execute();
        } catch (Exception $e) {
            Propel::log($e->getMessage(), Propel::LOG_ERR);
            throw new PropelException(sprintf('Unable to execute SELECT statement [%s]', $sql), 0, $e);
        }
        $obj = null;
        if ($row = $stmt->fetch(\PDO::FETCH_NUM)) {
            $obj = new ChildGoogleshoppingAccount();
            $obj->hydrate($row);
            GoogleshoppingAccountTableMap::addInstanceToPool($obj, (string) $key);
        }
        $stmt->closeCursor();

        return $obj;
    }

    /**
     * Find object by primary key.
     *
     * @param     mixed $key Primary key to use for the query
     * @param     ConnectionInterface $con A connection object
     *
     * @return ChildGoogleshoppingAccount|array|mixed the result, formatted by the current formatter
     */
    protected function findPkComplex($key, $con)
    {
        // As the query uses a PK condition, no limit(1) is necessary.
        $criteria = $this->isKeepQuery() ? clone $this : $this;
        $dataFetcher = $criteria
            ->filterByPrimaryKey($key)
            ->doSelect($con);

        return $criteria->getFormatter()->init($criteria)->formatOne($dataFetcher);
    }

    /**
     * Find objects by primary key
     * <code>
     * $objs = $c->findPks(array(12, 56, 832), $con);
     * </code>
     * @param     array $keys Primary keys to use for the query
     * @param     ConnectionInterface $con an optional connection object
     *
     * @return ObjectCollection|array|mixed the list of results, formatted by the current formatter
     */
    public function findPks($keys, $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getReadConnection($this->getDbName());
        }
        $this->basePreSelect($con);
        $criteria = $this->isKeepQuery() ? clone $this : $this;
        $dataFetcher = $criteria
            ->filterByPrimaryKeys($keys)
            ->doSelect($con);

        return $criteria->getFormatter()->init($criteria)->format($dataFetcher);
    }

    /**
     * Filter the query by primary key
     *
     * @param     mixed $key Primary key to use for the query
     *
     * @return ChildGoogleshoppingAccountQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {

        return $this->addUsingAlias(GoogleshoppingAccountTableMap::ID, $key, Criteria::EQUAL);
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return ChildGoogleshoppingAccountQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {

        return $this->addUsingAlias(GoogleshoppingAccountTableMap::ID, $keys, Criteria::IN);
    }

    /**
     * Filter the query on the id column
     *
     * Example usage:
     * <code>
     * $query->filterById(1234); // WHERE id = 1234
     * $query->filterById(array(12, 34)); // WHERE id IN (12, 34)
     * $query->filterById(array('min' => 12)); // WHERE id > 12
     * </code>
     *
     * @param     mixed $id The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildGoogleshoppingAccountQuery The current query, for fluid interface
     */
    public function filterById($id = null, $comparison = null)
    {
        if (is_array($id)) {
            $useMinMax = false;
            if (isset($id['min'])) {
                $this->addUsingAlias(GoogleshoppingAccountTableMap::ID, $id['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($id['max'])) {
                $this->addUsingAlias(GoogleshoppingAccountTableMap::ID, $id['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(GoogleshoppingAccountTableMap::ID, $id, $comparison);
    }

    /**
     * Filter the query on the merchant_id column
     *
     * Example usage:
     * <code>
     * $query->filterByMerchantId('fooValue');   // WHERE merchant_id = 'fooValue'
     * $query->filterByMerchantId('%fooValue%'); // WHERE merchant_id LIKE '%fooValue%'
     * </code>
     *
     * @param     string $merchantId The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildGoogleshoppingAccountQuery The current query, for fluid interface
     */
    public function filterByMerchantId($merchantId = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($merchantId)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $merchantId)) {
                $merchantId = str_replace('*', '%', $merchantId);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(GoogleshoppingAccountTableMap::MERCHANT_ID, $merchantId, $comparison);
    }

    /**
     * Filter the query on the default_country_id column
     *
     * Example usage:
     * <code>
     * $query->filterByDefaultCountryId(1234); // WHERE default_country_id = 1234
     * $query->filterByDefaultCountryId(array(12, 34)); // WHERE default_country_id IN (12, 34)
     * $query->filterByDefaultCountryId(array('min' => 12)); // WHERE default_country_id > 12
     * </code>
     *
     * @see       filterByCountry()
     *
     * @param     mixed $defaultCountryId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildGoogleshoppingAccountQuery The current query, for fluid interface
     */
    public function filterByDefaultCountryId($defaultCountryId = null, $comparison = null)
    {
        if (is_array($defaultCountryId)) {
            $useMinMax = false;
            if (isset($defaultCountryId['min'])) {
                $this->addUsingAlias(GoogleshoppingAccountTableMap::DEFAULT_COUNTRY_ID, $defaultCountryId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($defaultCountryId['max'])) {
                $this->addUsingAlias(GoogleshoppingAccountTableMap::DEFAULT_COUNTRY_ID, $defaultCountryId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(GoogleshoppingAccountTableMap::DEFAULT_COUNTRY_ID, $defaultCountryId, $comparison);
    }

    /**
     * Filter the query on the default_currency_id column
     *
     * Example usage:
     * <code>
     * $query->filterByDefaultCurrencyId(1234); // WHERE default_currency_id = 1234
     * $query->filterByDefaultCurrencyId(array(12, 34)); // WHERE default_currency_id IN (12, 34)
     * $query->filterByDefaultCurrencyId(array('min' => 12)); // WHERE default_currency_id > 12
     * </code>
     *
     * @see       filterByCurrency()
     *
     * @param     mixed $defaultCurrencyId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildGoogleshoppingAccountQuery The current query, for fluid interface
     */
    public function filterByDefaultCurrencyId($defaultCurrencyId = null, $comparison = null)
    {
        if (is_array($defaultCurrencyId)) {
            $useMinMax = false;
            if (isset($defaultCurrencyId['min'])) {
                $this->addUsingAlias(GoogleshoppingAccountTableMap::DEFAULT_CURRENCY_ID, $defaultCurrencyId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($defaultCurrencyId['max'])) {
                $this->addUsingAlias(GoogleshoppingAccountTableMap::DEFAULT_CURRENCY_ID, $defaultCurrencyId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(GoogleshoppingAccountTableMap::DEFAULT_CURRENCY_ID, $defaultCurrencyId, $comparison);
    }

    /**
     * Filter the query on the is_default column
     *
     * Example usage:
     * <code>
     * $query->filterByIsDefault(true); // WHERE is_default = true
     * $query->filterByIsDefault('yes'); // WHERE is_default = true
     * </code>
     *
     * @param     boolean|string $isDefault The value to use as filter.
     *              Non-boolean arguments are converted using the following rules:
     *                * 1, '1', 'true',  'on',  and 'yes' are converted to boolean true
     *                * 0, '0', 'false', 'off', and 'no'  are converted to boolean false
     *              Check on string values is case insensitive (so 'FaLsE' is seen as 'false').
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildGoogleshoppingAccountQuery The current query, for fluid interface
     */
    public function filterByIsDefault($isDefault = null, $comparison = null)
    {
        if (is_string($isDefault)) {
            $is_default = in_array(strtolower($isDefault), array('false', 'off', '-', 'no', 'n', '0', '')) ? false : true;
        }

        return $this->addUsingAlias(GoogleshoppingAccountTableMap::IS_DEFAULT, $isDefault, $comparison);
    }

    /**
     * Filter the query by a related \GoogleShopping\Model\Thelia\Model\Country object
     *
     * @param \GoogleShopping\Model\Thelia\Model\Country|ObjectCollection $country The related object(s) to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildGoogleshoppingAccountQuery The current query, for fluid interface
     */
    public function filterByCountry($country, $comparison = null)
    {
        if ($country instanceof \GoogleShopping\Model\Thelia\Model\Country) {
            return $this
                ->addUsingAlias(GoogleshoppingAccountTableMap::DEFAULT_COUNTRY_ID, $country->getId(), $comparison);
        } elseif ($country instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(GoogleshoppingAccountTableMap::DEFAULT_COUNTRY_ID, $country->toKeyValue('PrimaryKey', 'Id'), $comparison);
        } else {
            throw new PropelException('filterByCountry() only accepts arguments of type \GoogleShopping\Model\Thelia\Model\Country or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the Country relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return ChildGoogleshoppingAccountQuery The current query, for fluid interface
     */
    public function joinCountry($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('Country');

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
            $this->addJoinObject($join, 'Country');
        }

        return $this;
    }

    /**
     * Use the Country relation Country object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return   \GoogleShopping\Model\Thelia\Model\CountryQuery A secondary query class using the current class as primary query
     */
    public function useCountryQuery($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        return $this
            ->joinCountry($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'Country', '\GoogleShopping\Model\Thelia\Model\CountryQuery');
    }

    /**
     * Filter the query by a related \GoogleShopping\Model\Thelia\Model\Currency object
     *
     * @param \GoogleShopping\Model\Thelia\Model\Currency|ObjectCollection $currency The related object(s) to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildGoogleshoppingAccountQuery The current query, for fluid interface
     */
    public function filterByCurrency($currency, $comparison = null)
    {
        if ($currency instanceof \GoogleShopping\Model\Thelia\Model\Currency) {
            return $this
                ->addUsingAlias(GoogleshoppingAccountTableMap::DEFAULT_CURRENCY_ID, $currency->getId(), $comparison);
        } elseif ($currency instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(GoogleshoppingAccountTableMap::DEFAULT_CURRENCY_ID, $currency->toKeyValue('PrimaryKey', 'Id'), $comparison);
        } else {
            throw new PropelException('filterByCurrency() only accepts arguments of type \GoogleShopping\Model\Thelia\Model\Currency or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the Currency relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return ChildGoogleshoppingAccountQuery The current query, for fluid interface
     */
    public function joinCurrency($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('Currency');

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
            $this->addJoinObject($join, 'Currency');
        }

        return $this;
    }

    /**
     * Use the Currency relation Currency object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return   \GoogleShopping\Model\Thelia\Model\CurrencyQuery A secondary query class using the current class as primary query
     */
    public function useCurrencyQuery($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        return $this
            ->joinCurrency($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'Currency', '\GoogleShopping\Model\Thelia\Model\CurrencyQuery');
    }

    /**
     * Filter the query by a related \GoogleShopping\Model\GoogleshoppingProductSynchronisation object
     *
     * @param \GoogleShopping\Model\GoogleshoppingProductSynchronisation|ObjectCollection $googleshoppingProductSynchronisation  the related object to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildGoogleshoppingAccountQuery The current query, for fluid interface
     */
    public function filterByGoogleshoppingProductSynchronisation($googleshoppingProductSynchronisation, $comparison = null)
    {
        if ($googleshoppingProductSynchronisation instanceof \GoogleShopping\Model\GoogleshoppingProductSynchronisation) {
            return $this
                ->addUsingAlias(GoogleshoppingAccountTableMap::ID, $googleshoppingProductSynchronisation->getGoogleshoppingAccountId(), $comparison);
        } elseif ($googleshoppingProductSynchronisation instanceof ObjectCollection) {
            return $this
                ->useGoogleshoppingProductSynchronisationQuery()
                ->filterByPrimaryKeys($googleshoppingProductSynchronisation->getPrimaryKeys())
                ->endUse();
        } else {
            throw new PropelException('filterByGoogleshoppingProductSynchronisation() only accepts arguments of type \GoogleShopping\Model\GoogleshoppingProductSynchronisation or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the GoogleshoppingProductSynchronisation relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return ChildGoogleshoppingAccountQuery The current query, for fluid interface
     */
    public function joinGoogleshoppingProductSynchronisation($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('GoogleshoppingProductSynchronisation');

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
            $this->addJoinObject($join, 'GoogleshoppingProductSynchronisation');
        }

        return $this;
    }

    /**
     * Use the GoogleshoppingProductSynchronisation relation GoogleshoppingProductSynchronisation object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return   \GoogleShopping\Model\GoogleshoppingProductSynchronisationQuery A secondary query class using the current class as primary query
     */
    public function useGoogleshoppingProductSynchronisationQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinGoogleshoppingProductSynchronisation($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'GoogleshoppingProductSynchronisation', '\GoogleShopping\Model\GoogleshoppingProductSynchronisationQuery');
    }

    /**
     * Exclude object from result
     *
     * @param   ChildGoogleshoppingAccount $googleshoppingAccount Object to remove from the list of results
     *
     * @return ChildGoogleshoppingAccountQuery The current query, for fluid interface
     */
    public function prune($googleshoppingAccount = null)
    {
        if ($googleshoppingAccount) {
            $this->addUsingAlias(GoogleshoppingAccountTableMap::ID, $googleshoppingAccount->getId(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

    /**
     * Deletes all rows from the googleshopping_account table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(GoogleshoppingAccountTableMap::DATABASE_NAME);
        }
        $affectedRows = 0; // initialize var to track total num of affected rows
        try {
            // use transaction because $criteria could contain info
            // for more than one table or we could emulating ON DELETE CASCADE, etc.
            $con->beginTransaction();
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            GoogleshoppingAccountTableMap::clearInstancePool();
            GoogleshoppingAccountTableMap::clearRelatedInstancePool();

            $con->commit();
        } catch (PropelException $e) {
            $con->rollBack();
            throw $e;
        }

        return $affectedRows;
    }

    /**
     * Performs a DELETE on the database, given a ChildGoogleshoppingAccount or Criteria object OR a primary key value.
     *
     * @param mixed               $values Criteria or ChildGoogleshoppingAccount object or primary key or array of primary keys
     *              which is used to create the DELETE statement
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).  This includes CASCADE-related rows
     *                if supported by native driver or if emulated using Propel.
     * @throws PropelException Any exceptions caught during processing will be
     *         rethrown wrapped into a PropelException.
     */
     public function delete(ConnectionInterface $con = null)
     {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(GoogleshoppingAccountTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(GoogleshoppingAccountTableMap::DATABASE_NAME);

        $affectedRows = 0; // initialize var to track total num of affected rows

        try {
            // use transaction because $criteria could contain info
            // for more than one table or we could emulating ON DELETE CASCADE, etc.
            $con->beginTransaction();


        GoogleshoppingAccountTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            GoogleshoppingAccountTableMap::clearRelatedInstancePool();
            $con->commit();

            return $affectedRows;
        } catch (PropelException $e) {
            $con->rollBack();
            throw $e;
        }
    }

} // GoogleshoppingAccountQuery
