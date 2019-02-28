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

// Route::get('/', 'Auth\LoginController@login');

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Auth::routes(['verify' => true]);
Route::get('/home', 'HomeController@index')->name('home');

Route::post('/login', 'Auth\LoginController@login');

Route::get('/logout', 'Auth\LoginController@logout');

Route::post('/register', 'UserController@getRegister');

Route::get('/user/verify/{token}', 'Auth\RegisterController@verifyUser');

// Route::get('profile',function(){
//     return "This is profile";
// })->middleware('verified');



