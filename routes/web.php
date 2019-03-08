<?php

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

Auth::routes();
Route::get('/home', 'HomeController@index')->name('home');

//login
Route::post('/login', 'Auth\LoginController@login');

//logout
Route::get('/logout', 'Auth\LoginController@logout');

//register
Route::post('/register','Auth\RegisterController@register');

//new Author
Route::get('/author/authorList', 'Author\AuthorController@getAuthor');
Route::post('/newAuthor', 'Author\AuthorController@addAuthor');

//edit author
Route::get('/author/editAuthor/{autEdit_id}','Author\AuthorController@edit');
Route::post('/updateAuthor','Author\AuthorController@update');

//delete author
Route::get('/author/deleteAuthor/{id}','Author\AuthorController@delete');

//search author
Route::post('/searchAuthor','Author\AuthorController@getAuthor');

//new Genre
Route::get('/genre/genreList', 'Genre\GenreController@getGenre');
Route::post('/newGenre', 'Genre\GenreController@addGenre');

//update Genre
Route::get('/genre/editGenre/{genEdit_id}','Genre\GenreController@edit');
Route::post('/updateGenre','Genre\GenreController@update');

//delete Genre
Route::get('/genre/deleteGenre/{id}','Genre\GenreController@delete');

//search Genre
Route::post('/searchGenre','Genre\GenreController@getGenre');

//new book
Route::get('/book/bookList', 'Book\BookController@getBook');
Route::post('/newBook', 'Book\BookController@addBook');

//update book
Route::get('/book/editBook/{bookEdit_id}','Book\BookController@edit');
Route::post('/updateBook','Book\BookController@update');

//search Genre
Route::post('/searchBook','Book\BookController@getBook');






