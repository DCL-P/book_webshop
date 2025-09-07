<?php

namespace App\Repository;

use App\Entity\BookLists;
use App\Entity\User;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<BookLists>
 */
class BookListsRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, BookLists::class);
    }

    //    /**
    //     * @return BookLists[] Returns an array of BookLists objects
    //     */
    //    public function findByExampleField($value): array
    //    {
    //        return $this->createQueryBuilder('b')
    //            ->andWhere('b.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->orderBy('b.id', 'ASC')
    //            ->setMaxResults(10)
    //            ->getQuery()
    //            ->getResult()
    //        ;
    //    }

    //    public function findOneBySomeField($value): ?BookLists
    //    {
    //        return $this->createQueryBuilder('b')
    //            ->andWhere('b.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->getQuery()
    //            ->getOneOrNullResult()
    //        ;
    //    }

    public function createBookList($user, $book_list_name)
    {
        $bookList = new BookList;
        $bookList->setName($book_list_name);
        $bookList->setUser($user);

        $em = $this->getEntityManager();
        $em->persist($bookList);
        $em->flush;

        return $bookList;
    }

    // addBookToBooklist($book_list_id, $book_id)
    // {
        
    // }
}
