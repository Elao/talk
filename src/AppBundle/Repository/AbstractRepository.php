<?php

namespace AppBundle\Repository;

use Doctrine\ORM\EntityRepository;

/**
* Abstract Repository
*/
abstract class AbstractRepository extends EntityREpository
{
    /**
     * Create default QueryBuilder
     *
     * @return QueryBuilder
     */
    public function createDefaultQueryBuilder()
    {
        return $this->createQueryBuilder($this->getDefaultAlias());
    }

    /**
     * Get default alias
     *
     * @return string
     */
    public function getDefaultAlias()
    {
        return $this->getClassMetadata()->getTableName();
    }
}
