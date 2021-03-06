<?php

namespace APP\EmpresaBundle\Repository;

/**
 * FotosRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class FotosRepository extends \Doctrine\ORM\EntityRepository {

    public function trasBanners() {
        $qb = $this->createQueryBuilder('u');
        $qb->where($qb->expr()->isNotNull('u.empresarbanner'));
        return $qb->getQuery()->getResult(); 
    }

}
