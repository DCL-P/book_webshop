<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\HttpFoundation\RequestStack;
use App\Entity\Books;
use App\Entity\BookLists;
use App\Form\BookListsForm;
use Doctrine\ORM\EntityManagerInterface;

final class BookListsController extends AbstractController
{
    #[Route('/book-lists', name: 'book-lists')]
    public function index(RequestStack $rs, EntityManagerInterface $manager): Response
    {
        $session = $rs?->getSession();

        $temp_book_list = $session->get('temp_book_list');



        $has_books = false;
        $book_lists = [];

        $user = $this?->getUser();

        if($user)
        {
            $user_id = $user->getId();

            $user_book_lists = $manager->getRepository(BookLists::class)->findBy(['user'=>$user_id]);

            $has_books = true;

            
            $list_of_booklists = $user_book_lists;

            foreach($list_of_booklists as $book_list)
            {
                $book_lists[] = ['id'=>$book_list->getId(), 'name'=>$book_list->getName()];
            }  

        }
        else
        {
            if(!empty($temp_book_list['books']))
            {
                $book_lists[] = ['name'=>$temp_book_list['name']];
                $has_books = true;
            }
        }

        return $this->render('book_lists/index.html.twig', ['user'=>$user, 'book_lists'=>$book_lists, 'has_books'=>$has_books]);
    }
}
