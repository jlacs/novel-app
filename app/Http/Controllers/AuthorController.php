<?php

namespace App\Http\Controllers;

use App\Entities\Book;
use App\Entities\Author;
use Illuminate\Http\Request;
use Doctrine\ORM\EntityManagerInterface;

class AuthorController extends Controller
{
    private $em;

    public function __construct(EntityManagerInterface $em)
    {
        $this->em = $em;
    }

    public function index()
    {
        $authors = $this->em->getRepository(Author::class)->findAll();

        dd($authors);
    }
}
