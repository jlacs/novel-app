<?php

namespace App\Entities;

use Doctrine\ORM\Mapping AS ORM;
use Doctrine\Common\Collections\ArrayCollection;
use App\Entities\Book;

/**
 * @ORM\Entity
 * @ORM\Table(name="authors")
 */
class Author
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    protected int $id;

    /**
     * @ORM\Column(type="string")
     */
    protected string $firstname;

    /**
     * @ORM\Column(type="string")
     */
    protected string $lastname;

    /**
    * @ORM\OneToMany(targetEntity="Book", mappedBy="author", cascade={"persist"})
    * @var ArrayCollection|Book[]
    */
    protected $books;

    /**
    * @param $firstname
    * @param $lastname
    */
    public function __construct(string $firstname, string $lastname)
    {
        $this->firstname = $firstname;
        $this->lastname  = $lastname;

        $this->books = new ArrayCollection;
    }

    /**
     * Get the value of id
     *
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * Get the value of firstname
     *
     * @return string
     */
    public function getFirstname(): string
    {
        return $this->firstname;
    }

    /**
     * Set the value of firstname
     *
     * @param string $firstname
     *
     * @return self
     */
    public function setFirstname(string $firstname): self
    {
        $this->firstname = $firstname;

        return $this;
    }

    /**
     * Get the value of lastname
     *
     * @return string
     */
    public function getLastname(): string
    {
        return $this->lastname;
    }

    /**
     * Set the value of lastname
     *
     * @param string $lastname
     *
     * @return self
     */
    public function setLastname(string $lastname): self
    {
        $this->lastname = $lastname;

        return $this;
    }

    /**
     * Get the value of books
     */
    public function getBooks()
    {
        return $this->books;
    }

    /**
     * Set the value of books
     */
    public function setBooks($books): self
    {
        $this->books = $books;

        return $this;
    }

    public function addBook(Book $book)
    {
        if(!$this->books->contains($book)) {
            $book->setAuthor($this);
            $this->books->add($book);
        }
    }
}