<?php

namespace App\Repository;

use App\Entity\RecyclingCenter;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<RecyclingCenter>
 *
 * @method RecyclingCenter|null find($id, $lockMode = null, $lockVersion = null)
 * @method RecyclingCenter|null findOneBy(array $criteria, array $orderBy = null)
 * @method RecyclingCenter[]    findAll()
 * @method RecyclingCenter[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class RecyclingCenterRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, RecyclingCenter::class);
    }

    public function add(RecyclingCenter $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(RecyclingCenter $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

//    /**
//     * @return RecyclingCenter[] Returns an array of RecyclingCenter objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('r')
//            ->andWhere('r.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('r.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?RecyclingCenter
//    {
//        return $this->createQueryBuilder('r')
//            ->andWhere('r.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
