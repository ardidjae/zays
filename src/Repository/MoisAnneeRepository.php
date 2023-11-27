<?php

namespace App\Repository;

use App\Entity\MoisAnnee;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<MoisAnnee>
 *
 * @method MoisAnnee|null find($id, $lockMode = null, $lockVersion = null)
 * @method MoisAnnee|null findOneBy(array $criteria, array $orderBy = null)
 * @method MoisAnnee[]    findAll()
 * @method MoisAnnee[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class MoisAnneeRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, MoisAnnee::class);
    }

//    /**
//     * @return MoisAnnee[] Returns an array of MoisAnnee objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('m')
//            ->andWhere('m.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('m.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?MoisAnnee
//    {
//        return $this->createQueryBuilder('m')
//            ->andWhere('m.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
