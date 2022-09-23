<?php

namespace App\Repository;

use App\Entity\WasteContainerModel;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<WasteContainerModel>
 *
 * @method WasteContainerModel|null find($id, $lockMode = null, $lockVersion = null)
 * @method WasteContainerModel|null findOneBy(array $criteria, array $orderBy = null)
 * @method WasteContainerModel[]    findAll()
 * @method WasteContainerModel[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class WasteContainerModelRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, WasteContainerModel::class);
    }

    public function add(WasteContainerModel $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(WasteContainerModel $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

//    /**
//     * @return WasteContainerModel[] Returns an array of WasteContainerModel objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('w')
//            ->andWhere('w.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('w.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?WasteContainerModel
//    {
//        return $this->createQueryBuilder('w')
//            ->andWhere('w.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
