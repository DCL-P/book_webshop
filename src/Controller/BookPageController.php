<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Attribute\Route;
use App\Repository\BooksRepository;
use Symfony\Component\HttpFoundation\RequestStack;
use App\Form\AddBookForm;
use App\Form\SubmitForm;

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
    public function index(int $book_id, Request $request): Response
    {
        $confirmation_message = '';

        //fetching the book
        $book_data_object = $this->BooksRepository->FetchBookByID($book_id);


        //forms for both the logged in and temp user
        $temp_form = $this->createForm(SubmitForm::class);
        $logged_in_form = $this->createForm(AddBookForm::class);

        $user = $this->getUser();
        $used_form = NULL;


        //if user logged in, use logged_in_form, otherwise use temp_form
        if($user)
        {
            $logged_in_form = $this->createForm(AddBookForm::class);

            $used_form = $logged_in_form;

            $logged_in_form->handleRequest($request);

            if($logged_in_form->isSubmitted() && $logged_in_form->isValid())
            {
                $selectedBookLists = $logged_in_form->get('BookLists')->getData();

                if(!empty($selectedBookLists))
                {
                    if(!empty($user)){

                    } else {
                        $this->addBookToList($book_id);
                    }
                }
            }
        }
        else
        {
            $temp_form = $this->createForm(SubmitForm::class);

            $used_form = $temp_form;

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
            'add_to_booklist_form' => $used_form,
            'user'=>$user
        ]);
    }
}
