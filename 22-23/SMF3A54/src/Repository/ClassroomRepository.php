<?php

namespace App\Repository;

use App\Entity\Classroom;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Classroom>
 *
 * @method Classroom|null find($id, $lockMode = null, $lockVersion = null)
 * @method Classroom|null findOneBy(array $criteria, array $orderBy = null)
 * @method Classroom[]    findAll()
 * @method Classroom[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ClassroomRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Classroom::class);
    }

    public function save(Classroom $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(Classroom $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

//    /**
//     * @return Classroom[] Returns an array of Classroom objects
//     */
   public function findByNameField($value): array
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.Name = :val')
            ->setParameter('val', $value)
            ->orderBy('c.id', 'DESC')
            ->setMaxResults(1)
            ->getQuery()
            ->getResult()
       ;
    }

    public function findByNameFieldDQL($value): array
    {
        $query=$this->getEntityManager()->createQuery('Select c from App\Entity\Classroom c where c.Name= :val ORDER BY c.id');
        $query->setParameter('val', $value);
        return $query->getResult();
    }

//    public function findOneBySomeField($value): ?Classroom
//    {
//        return $this->createQueryBuilder('c')
//            ->andWhere('c.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
