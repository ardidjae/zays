<?php

namespace App\Repository;

use App\Entity\Bail;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Bail>
 *
 * @method Bail|null find($id, $lockMode = null, $lockVersion = null)
 * @method Bail|null findOneBy(array $criteria, array $orderBy = null)
 * @method Bail[]    findAll()
 * @method Bail[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class BailRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Bail::class);
    }

//    /**
//     * @return Bail[] Returns an array of Bail objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('b')
//            ->andWhere('b.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('b.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?Bail
//    {
//        return $this->createQueryBuilder('b')
//            ->andWhere('b.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
