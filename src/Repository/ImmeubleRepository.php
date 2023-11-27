<?php

namespace App\Repository;

use App\Entity\Immeuble;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Immeuble>
 *
 * @method Immeuble|null find($id, $lockMode = null, $lockVersion = null)
 * @method Immeuble|null findOneBy(array $criteria, array $orderBy = null)
 * @method Immeuble[]    findAll()
 * @method Immeuble[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ImmeubleRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Immeuble::class);
    }

//    /**
//     * @return Immeuble[] Returns an array of Immeuble objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('i')
//            ->andWhere('i.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('i.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?Immeuble
//    {
//        return $this->createQueryBuilder('i')
//            ->andWhere('i.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
