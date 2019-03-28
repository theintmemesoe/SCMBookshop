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

Route::get('/welcome', function () {
    return view('welcome');
});

Auth::routes();
Route::get('/home', 'HomeController@index')->name('home');

//login
Route::get('/', function () {
    return view('auth.login');
});
Route::post('/login', 'Auth\LoginController@login');

//logout
Route::get('/logout', 'Auth\FacebookController@logout');

//register
Route::post('/register', 'Auth\RegisterController@register');

//Author
Route::group(['middleware' => ['admin']], function () {
    Route::get('/addAuthor', function () {
        return view('author.addAuthor');
    });
});
Route::get('/author/authorList', 'Author\AuthorController@getAuthor');
Route::post('/newAuthor', 'Author\AuthorController@addAuthor');
Route::get('/author/editAuthor/{autEdit_id}', 'Author\AuthorController@edit');
Route::post('/updateAuthor', 'Author\AuthorController@update');
Route::get('/author/deleteAuthor/{id}', 'Author\AuthorController@delete');
Route::post('/searchAuthor', 'Author\AuthorController@getAuthor');

//Genre
Route::group(['middleware' => ['admin']], function () {
    Route::get('/addGenre', function () {
        return view('genre.addGenre');
    });
});
Route::get('/genre/genreList', 'Genre\GenreController@getGenre');
Route::post('/newGenre', 'Genre\GenreController@addGenre');
Route::get('/genre/editGenre/{genEdit_id}', 'Genre\GenreController@edit');
Route::post('/updateGenre', 'Genre\GenreController@update');
Route::get('/genre/deleteGenre/{id}', 'Genre\GenreController@delete');
Route::post('/searchGenre', 'Genre\GenreController@getGenre');

//book
Route::group(['middleware' => ['admin']], function () {
    Route::get('/addBook', 'Book\BookController@callBookList');
    Route::post('/newBook', 'Book\BookController@addBook');
    Route::get('/getImage/{file_name}', 'Book\BookController@getImage');
    Route::get('/getPDF/{file_name}', 'Book\BookController@getPDF');
    Route::post('/uploadCSV', 'Book\BookController@uploadCSV');
    Route::get('/downloadCSV', 'Book\BookController@downloadCSV');
    Route::get('/book/bookDetail/{id}', 'Book\BookController@getBookDetail');
    Route::get('/book/editBook/{bookEdit_id}', 'Book\BookController@edit');
    Route::post('/updateBook', 'Book\BookController@update');
    Route::get('/book/deleteBook/{id}', 'Book\BookController@delete');
});
Route::group(['middleware' => ['auth']], function () {
    Route::post('/searchBook', 'Book\BookController@getBook');
    Route::get('/book/bookList', 'Book\BookController@getBook');
});

//Order Cart
Route::group(['middleware' => ['user']], function () {
    Route::get('/cart/cartList', 'Cart\CartController@getCart');
    Route::get('/cart/addToCart/{id}', 'Cart\CartController@addToCart');
    Route::get('/cart/removeCart/{id}', 'Cart\CartController@removeCart');
    Route::get('/cart/clearCart', 'Cart\CartController@clearCart');
    Route::post('/cart/confirmBook', 'Cart\CartController@confirmBook');
    Route::get('/order/orderList', 'Order\OrderController@getOrder');
    Route::get('/order/backOrder', 'Order\OrderController@backOrderConfirm');
    Route::get('/order/orderConfirm', 'Order\OrderController@orderConfirm');
});

Route::get('/auth/redirect/{provider}', 'FacebookController@redirect');
Route::get('/auth/google/callback', 'FacebookController@callback');
