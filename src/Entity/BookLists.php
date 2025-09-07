<?php

namespace App\Entity;

use App\Repository\BookListsRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: BookListsRepository::class)]
class BookLists
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'bookLists')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Users $user = null;

    /**
     * @var Collection<int, Books>
     */
    #[ORM\ManyToMany(targetEntity: Books::class, inversedBy: 'ConnectedLists')]
    private Collection $list;

    #[ORM\Column(length: 100)]
    private ?string $name = null;

    public function __construct()
    {
        $this->list = new ArrayCollection();
    }

    public function AddBook(Book $book): self
    {
        if(!$this->books->contains($book))
        {
            $this->books[] = $book;
        }
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getUser(): ?Users
    {
        return $this->user;
    }

    public function setUser(?Users $user): static
    {
        $this->user = $user;

        return $this;
    }

    /**
     * @return Collection<int, Books>
     */
    public function getList(): Collection
    {
        return $this->list;
    }

    public function addList(Books $list): static
    {
        if (!$this->list->contains($list)) {
            $this->list->add($list);
        }

        return $this;
    }

    public function removeList(Books $list): static
    {
        $this->list->removeElement($list);

        return $this;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): static
    {
        $this->name = $name;

        return $this;
    }
}
