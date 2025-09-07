<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\HttpFoundation\RequestStack;
use App\Entity\Books;
use Doctrine\ORM\EntityManagerInterface;

final class BookListController extends AbstractController
{
    #[Route('/book-list/{book-list-id}', name: 'book-list')]
    public function index(RequestStack $rs, EntityManagerInterface $manager): Response
    {
        $session = $rs->getSession();

        $temp_book_list = $session->get('temp_book_list');

        if(!empty($temp_book_list))
        {
            $all_books = $manager->getRepository(Books::class)->findBy(['id'=>$temp_book_list['books']]);

            $list_name = $temp_book_list['name'];
        }




        return $this->render('book_list/index.html.twig', ['all_books' => $all_books, 'book_list_name'=>$list_name]);
    }
}
