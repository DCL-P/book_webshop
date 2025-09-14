<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\HttpFoundation\RequestStack;
use App\Entity\Books;
use App\Entity\BookLists;
use Doctrine\ORM\EntityManagerInterface;

final class BookListController extends AbstractController
{
    #[Route('/book-list/{book_list_id}', name: 'book-list')]
    public function index(RequestStack $rs, EntityManagerInterface $manager, $book_list_id): Response
    {
        $session = $rs->getSession();

        $temp_book_list = $session->get('temp_book_list');

        $all_books = NULL;
        $list_name = NULL;

        $user = $this?->getUser();

        if($user)
        {
            $book_list = $manager->getRepository(BookLists::class)->find($book_list_id);
            $all_books = $book_list->getList();

            $list_name = $book_list->getName();
        }

        if(!empty($temp_book_list))
        {
            $all_books = $manager->getRepository(Books::class)->findBy(['id'=>$temp_book_list['books']]);

            $list_name = $temp_book_list['name'];
        }




        return $this->render('book_list/index.html.twig', ['all_books' => $all_books, 'book_list_name'=>$list_name, 'book_list_id'=>$book_list_id]);
    }

    #[Route('remove-book-list/{book_list_id}/{book_id}', name: 'remove-book')]
    public function removeBookFromList($book_list_id, $book_id, EntityManagerInterface $manager)
    {
        $book_list = $manager->getRepository(BookLists::class)->find($book_list_id);
        $book = $manager->getRepository(Books::class)->find($book_id);

        $book_list->removeBook($book);

        $manager->persist($book_list);

        $manager->flush();

        return $this->redirectToRoute('book-list', ['book_list_id'=>$book_list->getId()]);
    }
}
