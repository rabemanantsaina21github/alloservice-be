<?php

namespace Alloservice\SiteBundle\Repository;

/**
 * PartnerRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class PartnerRepository extends \Doctrine\ORM\EntityRepository
{
	public function getAll()
	{
		$qb = $this 	->createQueryBuilder('s')
						->orderBy('s.id','DESC');
		return $qb;
	}
}
