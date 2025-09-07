<?php

namespace App\Entity;

use App\Repository\UsersRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

//for password encryption
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;

//to implement user login 
use Symfony\Component\Security\Core\User\UserInterface;

#[ORM\Entity(repositoryClass: UsersRepository::class)]
class Users implements UserInterface, PasswordAuthenticatedUserInterface
{

    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 100)]
    private ?string $username = null;

    #[ORM\Column(length: 200)]
    private ?string $email = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $password = null;

    private $roles = [];

    // #[ORM\Column(type: Types::ARRAY, nullable: true)]
    // private ?array $book_list = null;

    /**
     * @var Collection<int, BookLists>
     */
    #[ORM\OneToMany(targetEntity: BookLists::class, mappedBy: 'user')]
    private Collection $bookLists;

    public function __construct()
    {
        $this->bookLists = new ArrayCollection();
    }

    public function getUserIdentifier(): string
    {
        return $this->email;
    }

    
    public function getRoles(): array
    {
        $roles = $this->roles;

        // guarantee every user at least has ROLE_USER
        $roles[] = 'ROLE_USER';

        return array_unique($roles);
    }

    public function eraseCredentials(): void
    {
        // If you store temporary sensitive data, clear it here
    }


    public function getId(): ?int
    {
        return $this->id;
    }

    public function setId(int $id): static
    {
        $this->id = $id;

        return $this;
    }

    public function getUsername(): ?string
    {
        return $this->username;
    }

    public function setUsername(string $username): static
    {
        $this->username = $username;

        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): static
    {
        $this->email = $email;

        return $this;
    }

    public function getPassword(): ?string
    {
        return $this->password;
    }

    public function setPassword(string $password): static
    {
        $this->password = $password;

        return $this;
    }

    public function getBookList(): ?array
    {
        return $this->book_list;
    }

    public function setBookList(?array $book_list): static
    {
        $this->book_list = $book_list;

        return $this;
    }

    /**
     * @return Collection<int, BookLists>
     */
    public function getBookLists(): Collection
    {
        return $this->bookLists;
    }

    public function addBookList(BookLists $bookList): static
    {
        if (!$this->bookLists->contains($bookList)) {
            $this->bookLists->add($bookList);
            $bookList->setUser($this);
        }

        return $this;
    }

    public function removeBookList(BookLists $bookList): static
    {
        if ($this->bookLists->removeElement($bookList)) {
            // set the owning side to null (unless already changed)
            if ($bookList->getUser() === $this) {
                $bookList->setUser(null);
            }
        }

        return $this;
    }
}
