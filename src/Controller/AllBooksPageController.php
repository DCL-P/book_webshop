<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Attribute\Route;
use App\Repository\BooksRepository;
use App\Form\GenreFiltersForm;
use Doctrine\ORM\EntityManagerInterface;

class AllBooksPageController extends AbstractController
{

    #[Route('/all-books', name:'all-books-route')]
    public function ShowAllBooksPage(Request $request, BooksRepository $BooksRepository, EntityManagerInterface $manager): Response
    {

        //all books list
        $AllBooks = $BooksRepository->FetchAllBooks();

        //genre filters
        $form = $this->createForm(GenreFiltersForm::class);

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
            $selectedGenres = $form->get('Genre')->getData();

            if(!empty($selectedGenres)){
                $filtered_genres_list = $BooksRepository->FetchBooksByGenre($selectedGenres);
                $AllBooks = $filtered_genres_list;
            }
        }

        return $this->render('all_books_page.html.twig', ['all_books_array' => $AllBooks, 'genre_filter' =>$form->createView()]);
    }
}
