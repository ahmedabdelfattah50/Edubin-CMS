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
Route::get('/', 'PostsController@index');

// ======== this is all routes of auth ==>> (login, register, ....)
Auth::routes();

// ======== Routes which have the middleware >> auth which must achieve it first to enter the route
Route::group(['middleware' => 'auth'], function (){
    // ======== this route to go to home page
    Route::get('/home', 'HomeController@index')->name('home');

    // ======== route resource of categories
    Route::resource('/categories','CategoriesController');

    // ======== route resource of categories
    Route::resource('/tags','TagsController');

    // ======== route resource of posts
    Route::resource('/posts','PostsController');

    // ======== route for trashed-posts restore posts
    Route::get('/trashed-posts/{id}', 'PostsController@restoreTrashed')->name('trashedPosts.restore');

    // ======== route for trashed-posts posts
    Route::get('/trashed-posts', 'PostsController@trashedPosts')->name('trashedPosts.index');
});
