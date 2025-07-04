<?php

namespace App\Repository;

use App\Entity\Books;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Books>
 */
class BooksRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Books::class);
    }

       /**
        * @return Books[] Returns an array of Books objects
        */
       public function FetchAllBooks(): array
       {
           return $this->createQueryBuilder('b')

               ->select('b')
               ->getQuery()
               ->getResult()
           ;
       }


       //find book by id
       public function FetchBookByID($value): array
       {
           return $this->createQueryBuilder('b')
               ->andWhere('b.id = :val')
               ->setParameter('val', $value)
               ->getQuery()
               ->getResult()
           ;
       }
}
