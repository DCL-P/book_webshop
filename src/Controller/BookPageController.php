<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Attribute\Route;
use App\Repository\BooksRepository;

final class BookPageController extends AbstractController
{
    #[Route('book/{book_id}', name: 'book_page')]
    public function index(int $book_id, BooksRepository $BooksRepository): Response
    {
        //fetching the book
        $book_data_object = $BooksRepository->FetchBookByID($book_id);

        return $this->render('book_page.html.twig', [
            'book_data' => $book_data_object,
        ]);
    }
}
