<?php

use App\Entities\Author;
use App\Entities\Book;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthorController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('author', [AuthorController::class, 'index']);

Route::get('add-author', function (\Doctrine\ORM\EntityManagerInterface $em) {
    $author = new Author('Agatha', 'Christie');

    $em->persist($author);
    $em->flush();

    return 'Added Author!';
});

Route::get('add-book', function (\Doctrine\ORM\EntityManagerInterface $em) {
    $author = $em->getRepository(Author::class)->find(1);
    $author->addBook(
        new Book('Whodunits')
    );

    $em->persist($author);
    $em->flush();

    return 'Added Book to the Author!';
});

Route::get('delete-author', function (\Doctrine\ORM\EntityManagerInterface $em) {
    $author = $em->getRepository(Author::class)->find(1);

    $em->remove($author);
    $em->flush();

    return 'Deleted Author!';
});