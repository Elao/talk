<?php

namespace FrontBundle\Repository;

/**
 * Talk Repository
 */
class TalkRepository extends AbstractRepository
{
    /**
     * Create default QueryBuilder
     *
     * @return QueryBuilder
     */
    public function createDefaultQueryBuilder()
    {
        $queryBuilder = parent::createDefaultQueryBuilder();

        $queryBuilder->orderBy(sprintf('%s.day', $queryBuilder->getRootAlias()), 'DESC');

        return $queryBuilder;
    }

    /**
     * Get list QueryBuilder
     *
     * @return
     */
    public function getListQueryBuilder()
    {
        return $this->createDefaultQueryBuilder();
    }

    /**
     * List talks
     *
     * @return aray
     */
    public function findAll()
    {
        return $this->getListQueryBuilder()->getQuery()->getResult();
    }
}
