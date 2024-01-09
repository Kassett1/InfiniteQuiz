<?php

namespace App\Repository;

use App\Entity\Flame;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Flame>
 *
 * @method Flame|null find($id, $lockMode = null, $lockVersion = null)
 * @method Flame|null findOneBy(array $criteria, array $orderBy = null)
 * @method Flame[]    findAll()
 * @method Flame[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class FlameRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Flame::class);
    }

//    /**
//     * @return Flame[] Returns an array of Flame objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('f')
//            ->andWhere('f.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('f.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?Flame
//    {
//        return $this->createQueryBuilder('f')
//            ->andWhere('f.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
