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

//    /**
//     * @return Student[] Returns an array of Student objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('s')
//            ->andWhere('s.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('s.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?Student
//    {
//        return $this->createQueryBuilder('s')
//            ->andWhere('s.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }


public function findStudentByClass($klass){
$em=$this->getEntityManager();

$req=$em->createQuery("select s from App\Entity\Student s join s.grades g where g.name=:espritclass");
$req->setParameter('espritclass',$klass);   
$result=$req->getResult();

return $result;
   
}

public function findStudentByClasspostion($klass){
    $em=$this->getEntityManager();
    
    $req=$em->createQuery("select s from App\Entity\Student s join s.grades g where g.name=?1 order By s.cin ASC");
    $req->setParameter('1',$klass);   
    $result=$req->getResult();
    
    return $result;
       
    }


    public function findAllQB(){
        $condition=false;
       $req= $this->createQueryBuilder('s')
       ->select('s.name') 
       ->addSelect('s.cin')
       ;
       if($condition){
    $req ->where("s.name='test'");
       }
       
       $preresult=$req->getQuery();
       $result=$preresult->getResult();
       return $result;
           
        }

        public function findStudentByClassQB($klass){
            $condition=false;
           $req= $this->createQueryBuilder('s')
           ->select('s.cin')
           ->join('s.grades','g')
           ->addSelect('g.name')
           ;
           if($condition){
        $req ->where("s.name='test'");
           }
           
           $preresult=$req->getQuery();
           $result=$preresult->getDQL();
           return $result;
               
            }
}
