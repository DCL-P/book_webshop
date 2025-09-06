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

    #[Route('book/{book_id}', name: 'book_page')]
    public function index(int $book_id, Request $request): Response
    {
        $confirmation_message = '';

        //fetching the book
        $book_data_object = $this->BooksRepository->FetchBookByID($book_id);


        //form for temp users
        $temp_form = $this->createForm(SubmitForm::class);

        $temp_form->handleRequest($request);

        if($temp_form->isSubmitted()){
            if($temp_form->get('submit_button')->isClicked()){
                $message = $this->addBookToList($book_id);
            }
        }







        //form for logged in users
        $form = $this->createForm(AddBookForm::class);

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid())
        {
            $selectedBookLists = $form->get('BookLists')->getData();

            if(!empty($selectedBookLists))
            {
                if(!empty($user)){

                } else {
                    $this->addBookToList($book_id);
                }
            }
        }



        return $this->render('book_page.html.twig', [
            'book_data' => $book_data_object,
            'message' => $confirmation_message,
            'add_to_booklist_form' => $form,
            'add_to_temp_booklist_form' => $temp_form,
        ]);
    }
}
