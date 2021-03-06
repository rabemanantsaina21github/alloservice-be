<?php

namespace Alloservice\BlogBundle\Repository;

/**
 * ArticleCategoryRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class ArticleCategoryRepository extends \Doctrine\ORM\EntityRepository
{
	public function getAll($direction = null)
	{
		$qb = $this 	->createQueryBuilder('c');
		if (!is_null($direction)) {
			$qb->orderBy('c.id',$direction);
		}else{
			$qb->orderBy('c.id','DESC');
		}
		return $qb->getQuery();
	}
}
