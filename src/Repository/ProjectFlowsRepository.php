<?php

namespace App\Repository;

use App\Entity\ProjectFlows;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<ProjectFlows>
 *
 * @method ProjectFlows|null find($id, $lockMode = null, $lockVersion = null)
 * @method ProjectFlows|null findOneBy(array $criteria, array $orderBy = null)
 * @method ProjectFlows[]    findAll()
 * @method ProjectFlows[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ProjectFlowsRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ProjectFlows::class);
    }

    public function save(ProjectFlows $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(ProjectFlows $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

//    /**
//     * @return ProjectFlows[] Returns an array of ProjectFlows objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('p')
//            ->andWhere('p.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('p.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?ProjectFlows
//    {
//        return $this->createQueryBuilder('p')
//            ->andWhere('p.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
