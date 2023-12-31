<?php

namespace App\Repository;

use App\Entity\Telecharger;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Telecharger>
 *
 * @method Telecharger|null find($id, $lockMode = null, $lockVersion = null)
 * @method Telecharger|null findOneBy(array $criteria, array $orderBy = null)
 * @method Telecharger[]    findAll()
 * @method Telecharger[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class TelechargerRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Telecharger::class);
    }

//    /**
//     * @return Telecharger[] Returns an array of Telecharger objects
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

//    public function findOneBySomeField($value): ?Telecharger
//    {
//        return $this->createQueryBuilder('t')
//            ->andWhere('t.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
