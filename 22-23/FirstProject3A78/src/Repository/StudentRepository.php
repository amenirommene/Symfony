<?php

namespace App\Repository;

use App\Entity\Student;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Student>
 *
 * @method Student|null find($id, $lockMode = null, $lockVersion = null)
 * @method Student|null findOneBy(array $criteria, array $orderBy = null)
 * @method Student[]    findAll()
 * @method Student[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class StudentRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Student::class);
    }

    public function save(Student $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(Student $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

//    /**
//     * @return Student[] Returns an array of Student objects
//     */
    public function findByEmailStudent($value): array
    {
       return $this->createQueryBuilder('a') //select * from Student
            ->andWhere('a.email  like :val')
            ->setParameter('val', '%'.'@'.$value)
           ->orderBy('a.nsc', 'ASC')
           ->setMaxResults(10)
           ->getQuery()
           ->getResult() //éxuécution de la requête et le retour du résultat
       ;
    }
    public function findByEmailStudentDQL($value): array
    {
        $entityM = $this->getEntityManager();
        $query = $entityM->createQuery(
            "select s from App\Entity\Student s where s.email like :val ");
        $query->setParameter('val','%'.'@'.$value);
        return $query->getResult();
    }
}
