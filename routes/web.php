<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

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

// ======== this route to go to welcome page
Route::get('/', 'CategoriesController@index');

// ======== this is all routes of auth ==>> (login, register, ....)
Auth::routes();

// ======== this route to go to home page
Route::get('/home', 'HomeController@index')->name('home');

// ======== route resource of categories
Route::resource('/categories','CategoriesController');

// ======== route resource of posts
Route::resource('/posts','PostsController');
Route::get('/trashed-posts', 'PostsController@trashedPosts')->name('trashedPosts.index');
