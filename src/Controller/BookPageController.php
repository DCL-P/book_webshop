<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Attribute\Route;
use App\Repository\BooksRepository;
use App\Entity\BookLists;
use App\Entity\Books;
use Symfony\Component\HttpFoundation\RequestStack;
use App\Form\AddBookForm;
use App\Form\SubmitForm;
use Doctrine\ORM\EntityManagerInterface;

final class BookPageController extends AbstractController
{
    private RequestStack $rm;
    private Request $request;
    private BooksRepository $BooksRepository;


    public function __construct(RequestStack $rm, BooksRepository $BooksRepository){
        $this->rm = $rm;
        $this->BooksRepository = $BooksRepository;
    }

    public function addBookToList(int $book_id)
    {

        $message = "This book has been successfully added to your book list!";
        $user = $this->getUser();

        if($user){

            
        } else {
            $session = $this->rm->getSession();

            $temp_guest_list = $session->get('temp_book_list', [
                'name' => 'demo list',
                'books' => []
            ]);


            if(!in_array($book_id, $temp_guest_list['books']))
            {
                $temp_guest_list['books'][] = $book_id;
            } else {
                $message = "This book already exist in your book list!";
            }

            $session->set('temp_book_list', $temp_guest_list);

            return $message;
        }

    }

    #[Route('book/{book_id}', name: 'book_page')]
    public function index(int $book_id, Request $request, EntityManagerInterface $em): Response
    {
        $confirmation_message = '';

        //fetching the book
        $book_data_object = $this->BooksRepository->FetchBookByID($book_id);


        //forms for both the logged in and temp user
        $temp_form = $this->createForm(SubmitForm::class);

        $logged_in_form = NULL;

        $user = $this?->getUser();


        //if user logged in, use logged_in_form, otherwise use temp_form
        if($user)
        {

            $all_user_book_lists = $em->getRepository(BookLists::class)->findBy(['user'=>$user]);

            $logged_in_form = $this->createForm(AddBookForm::class, null, ['book_lists'=>$all_user_book_lists]);

            $logged_in_form->handleRequest($request); //error comes from the request

            //DOESNT WORK!
            if($logged_in_form->isSubmitted() && $logged_in_form->isValid())
            {
                $selected_name = $logged_in_form->get('BookLists')->getData();

                $selected_book_list = $em->getRepository(BookLists::class)->findOneBy(['name'=>$selected_name->getName()]);

                $selected_book = $em->getRepository(Books::class)->find($book_id);

                $selected_book_list->AddBook($selected_book);

                $em->persist($selected_book_list);

                $em->flush();
            }
            //DOESNT WORK!
        }
        
        if(!$user)
        {

            $temp_form->handleRequest($request);

            if($temp_form->isSubmitted()){
                if($temp_form->get('submit_button')->isClicked()){
                    $message = $this->addBookToList($book_id);
                }
            }
        }



        return $this->render('book_page.html.twig', [
            'book_data' => $book_data_object,
            'message' => $confirmation_message,
            'add_to_booklist_form' => $logged_in_form,
            'add_to_temp_booklist_form' => $temp_form,
            'user'=>$user
        ]);
    }
}
