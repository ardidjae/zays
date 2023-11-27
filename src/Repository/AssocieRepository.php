<?php

namespace App\Repository;

use App\Entity\Associe;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Associe>
 *
 * @method Associe|null find($id, $lockMode = null, $lockVersion = null)
 * @method Associe|null findOneBy(array $criteria, array $orderBy = null)
 * @method Associe[]    findAll()
 * @method Associe[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class AssocieRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Associe::class);
    }

//    /**
//     * @return Associe[] Returns an array of Associe objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('a')
//            ->andWhere('a.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('a.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?Associe
//    {
//        return $this->createQueryBuilder('a')
//            ->andWhere('a.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
