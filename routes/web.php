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
Route::get('/authorList', 'Author\AuthorController@getAuthor');
Route::post('/newAuthor', 'Author\AuthorController@addAuthor');

//edit author

Route::get('/editAuthor/{autEdit_id}','Author\AuthorController@edit');
Route::post('/updateAuthor','Author\AuthorController@update');

//delete author
Route::get('/deleteAuthor/{id}','Author\AuthorController@delete');

Route::get('/searchAuthor','Author\AuthorController@search');

// Route::get('/mypagination', 'Author\AuthorController@myPagination');

// Route::post('/newAuthor',[
//     'uses'=>'Author\AuthorController@addAuthor',
//     'as'=>'newAuthor'
// ]);
// Route::get('/newAuthor',function() {
//     return view('author.add-author');
// });
//



