<?php

namespace App\EventListener;

use Symfony\Component\EventDispatcher\Attribute\AsEventListener;
use Symfony\Component\Security\Http\Event\LoginSuccessEvent;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\HttpFoundation\RequestStack;
use Doctrine\ORM\EntityManagerInterface;
use App\Entity\Books;
use App\Entity\BookLists;
use App\Repository\BookListsRepository;
use App\Repository\BooksRepository;


final class LoginListener
{
    private $requestStack;
    private $em;
    private $booksRepository;
    private $bookListRepository;

    public function __construct(EntityManagerInterface $em, BooksRepository $booksRepository, BookListsRepository $booksListRepository, RequestStack $requestStack)
    {
        $this->em = $em;
        $this->booksRepository = $booksRepository;
        $this->bookListRepository = $booksListRepository;
        $this->requestStack = $requestStack;
    }

    #[AsEventListener(event: LoginSuccessEvent::class)]
    public function __invoke(LoginSuccessEvent $event): void
    {

        $user = $event->getUser();
        if (!$user instanceof \App\Entity\Users) {
            return;
        }

        $request = $this->requestStack->getCurrentRequest();
        $session = $request?->getSession();

        if (!$session) {
            return;
        } else {

            $sessionBookIds = $session->get('temp_book_list');

            if (!empty($sessionBookIds['books'])) {
                //create new list
                $bookList = new BookLists();
                $bookList->setName('demo-list');

                //bind list to logged in user lists
                $bookList->setUser($user);

                //submit session books to new booklist
                foreach ($sessionBookIds['books'] as $bookId) {
                    $book = $this->booksRepository->find($bookId);
                    if ($book) {
                        $bookList->addBook($book);
                    }
                }

                //push changes to the db
                $this->em->persist($bookList);
                $this->em->flush();
            }
        }
    }
}
