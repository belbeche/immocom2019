<?php

namespace App\Repository;

use App\Entity\OptionAnnonce;
use App\Entity\Annonce;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method OptionAnnonce|null find($id, $lockMode = null, $lockVersion = null)
 * @method OptionAnnonce|null findOneBy(array $criteria, array $orderBy = null)
 * @method OptionAnnonce[]    findAll()
 * @method OptionAnnonce[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class OptionAnnonceRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, OptionAnnonce::class);
    }

    // /**
    //  * @return OptionAnnonce[] Returns an array of OptionAnnonce objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('o')
            ->andWhere('o.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('o.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?OptionAnnonce
    {
        return $this->createQueryBuilder('o')
            ->andWhere('o.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
