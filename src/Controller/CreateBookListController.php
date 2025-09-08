<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Attribute\Route;
use Doctrine\ORM\EntityManagerInterface;

use App\Entity\BookLists;
use App\Form\BookListForm;

final class CreateBookListController extends AbstractController
{
    #[Route('/create_book_list', name: 'app_create_book_list')]
    public function index(Request $request, EntityManagerInterface $em): Response
    {
        $user = $this?->getUser();

        $book_list_form = $this->createForm(BookListForm::class);

        if($user)
        {


            $book_list_form->handleRequest($request);

            if($book_list_form->isSubmitted() && $book_list_form->isValid())
            {
                $book_list_name = $book_list_form->get('name')->getData();

                $new_book_list = new BookLists;
                $new_book_list->setName($book_list_name);
                $new_book_list->setUser($user);

                $em->persist($new_book_list);
                $em->flush();

            }
        }



        return $this->render('create_book_list/index.html.twig', ['bookListForm'=>$book_list_form]);
    }
}
