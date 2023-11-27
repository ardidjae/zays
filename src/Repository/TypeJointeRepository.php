<?php

namespace App\Repository;

use App\Entity\TypeJointe;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<TypeJointe>
 *
 * @method TypeJointe|null find($id, $lockMode = null, $lockVersion = null)
 * @method TypeJointe|null findOneBy(array $criteria, array $orderBy = null)
 * @method TypeJointe[]    findAll()
 * @method TypeJointe[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class TypeJointeRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, TypeJointe::class);
    }

//    /**
//     * @return TypeJointe[] Returns an array of TypeJointe objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('t')
//            ->andWhere('t.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('t.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?TypeJointe
//    {
//        return $this->createQueryBuilder('t')
//            ->andWhere('t.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
