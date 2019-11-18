<?php

namespace App\Repository;

use App\Entity\Search;
use App\Entity\Annonce;
use Doctrine\ORM\Query;
use Doctrine\ORM\QueryBuilder;
use Doctrine\Common\Persistence\ManagerRegistry;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;

/**
 * @method Annonce|null find($id, $lockMode = null, $lockVersion = null)
 * @method Annonce|null findOneBy(array $criteria, array $orderBy = null)
 * @method Annonce[]    findAll()
 * @method Annonce[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class AnnonceRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Annonce::class);
    }

    /**
     * @return Query
     */

    public function findAllVisibleQuery(Search $search): Query 
    {
        $query = $this->findVisibleQuery();

        if ($search->getMaxPrice())
        {
            $query = $query
                ->andWhere('p.price <= :maxprice')
                ->setParameter('maxprice', $search->getMaxPrice());
        }

        if ($search->getLocation())
        {
            $query = $query
                ->setParameter('location', $search->getLocation());
        }
        if ($search->getAchat())
        {
            $query = $query
                ->setParameter('Achat', $search->getAchat());
        }

        if ($search->getMinSurface())
        {
            $query = $query
                ->andWhere('p.surface >= :minsurface')
                ->setParameter('minsurface', $search->getMinSurface());
        }
        // je récupere l'annonce de mes options 
        if($search->getAnnonces()->count() > 0)
        {
            $k = 0;
            // je fait une boucle voir si checked
            foreach ($search->getAnnonces() as $k => $optionAnnonce)
            {
                $k++;
                // je parcourt la base avec l'indice
                // optionAnnonces = relation Annonce
                $query = $query
                ->andWhere(":optionAnnonces$k MEMBER of p.optionAnnonces")
                ->setParameter("optionAnnonces$k", $optionAnnonce);
            }
        }
        return $query->getQuery();
    }
    /**
     * @return Annonces[];
     */
    public function findLatest(): array
    {
        return $this->findVisibleQuery()
            ->setMaxResults(4)
            ->getQuery()
            ->getResult();
    }

    /**
     * 
     */
    private function findVisibleQuery(): QueryBuilder
    {
        return $this->createQueryBuilder('p')
            ->where('p.sold = false');
    }

    // /**
    //  * @return Annonce[] Returns an array of Annonce objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('a')
            ->andWhere('a.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('a.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Annonce
    {
        return $this->createQueryBuilder('a')
            ->andWhere('a.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
