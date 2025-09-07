<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\HttpFoundation\RequestStack;
use App\Entity\Books;
use Doctrine\ORM\EntityManagerInterface;

final class BookListsController extends AbstractController
{
    #[Route('/book-lists', name: 'book-lists')]
    public function index(RequestStack $rs, EntityManagerInterface $manager): Response
    {
        $session = $rs->getSession();

        $temp_book_list = $session->get('temp_book_list');

        $all_books = NULL;
        $list_name = NULL;

        if(!empty($temp_book_list['books']))
        {
            $list_name =  $temp_book_list['name'];
            $all_books = $temp_book_list['books'];
        }

        // $all_book_ids = [];

        // $all_books = [];


        // //in more steps, since otherwise i hit symfony byte limit
        // if(!empty($temp_book_list['books']))
        // {
        //     $all_books = $manager->getRepository(Books::class)->findBy(['id' => $temp_book_list['books']]);
        //     foreach($temp_book_list['books'] as $book_id){
        //         $all_book_ids[] = $book_id; 
        //     }

        //     foreach($all_book_ids as $id){
        //         $all_books = $manager->getRepository(Books::class)->findBy(['id' => $temp_book_list['books']]);
        //         $all_books[$id] = $book;
        //     }
        // }

        



        return $this->render('book_lists/index.html.twig', ['book_list_name'=>$list_name, 'all_books'=>$all_books]);
    }
}
