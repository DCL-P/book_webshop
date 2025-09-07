<?php

namespace App\EventListener;

use Symfony\Component\EventDispatcher\Attribute\AsEventListener;
use Symfony\Component\Security\Http\Event\InteractiveLoginEvent;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Doctrine\ORM\EntityManagerInterface;
use App\Entity\Books;
use App\Entity\BooksLists;
use App\Repository\BookListsRepository;
use App\Repository\BooksRepository;


final class LoginListener
{
    private $session;
    private $em;
    private $booksRepository;

    public function __construct(EntityManagerInterface $em, BooksRepository $booksRepository, BookListsRepository $booksListRepository)
    {
        $this->em = $em;
        $this->booksRepository = $booksRepository;
        $this->bookListRepository = $bookListRepository;
    }

    #[AsEventListener(event: 'security.authentication_login')]
    public function onSecurityAuthenticationLogin(InteractiveLoginEvent $event, SessionInterface $session): void
    {
        $user = $event->getAuthenticationToken()->getUser();

        //return nothing if user isn't logged in
        if (!$user instanceof \App\Entity\User) {
            return;
        }

        $session_book_ids = $session->get('temp_book_list');
        
        if(!empty($session_book_ids['books']))
        {
            $bookList = $this->bookListRepository->createBookList('demo-list', $user);

            foreach($session_book_ids['books'] as $book_id)
            {
                $book = $this->bookRepository->FetchBookByID($book_id);
                $bookList->AddBook($book);
            }
        }

    }
}
