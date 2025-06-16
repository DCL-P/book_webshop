<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use App\Repository\BooksRepository;

class AllBooksPageController extends AbstractController
{

    #[Route('/all-books', name:'all-books-route')]
    public function ShowAllBooksPage(BooksRepository $BooksRepository): Response
    {

        //can't directly access like an array, since values are private
        $AllBooks = $BooksRepository->FetchAllBooks();

        return $this->render('all_books_page.html.twig', ['all_books_array' => $AllBooks]);
    }
}
