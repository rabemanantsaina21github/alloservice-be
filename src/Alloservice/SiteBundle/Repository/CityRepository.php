<?php

namespace Alloservice\SiteBundle\Repository;

/**
 * CityRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class CityRepository extends \Doctrine\ORM\EntityRepository
{
	public function getAll()
	{
		$qb = $this 	->createQueryBuilder('c')
						->orderBy('c.id','DESC');
		return $qb;
	}

	public function getTop($limit)
	{
		$qb = $this 	->createQueryBuilder('c')
						->orderBy('c.id','ASC')
						->getQuery()
						->setFirstResult(0)
        				->setMaxResults($limit)
        				->getResult();
		return $qb;
	}
}