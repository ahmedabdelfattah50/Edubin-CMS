<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

// ======== this route to go to welcome page
Route::get('/', 'HomeController@index')->name('website.home');

// ======== this is all routes of auth ==>> (login, register, ....)
Auth::routes();

/*
   ======== Routes which have the middleware >> auth which must achieve it first to enter the route
   ======== the user must be login in the website to enter those pages
*/
Route::group(['middleware' => 'auth'], function (){
    // ======== this route to go to home page
    Route::get('/homeWriterDash', 'DashboardController@homeWriterDash')->name('homeWriterDash');

    // ======== route resource of categories
    Route::resource('/categories','CategoriesController');

    // ======== route resource of categories
    Route::resource('/tags','TagsController');

    // ======== route resource of posts
    Route::resource('/posts','PostsController');

    // ======== route to get new posts
    Route::get('/new-posts', 'PostsController@getNewPosts')->name('getNewPosts.index');

    // ======== route for trashed-posts posts
    Route::get('/trashed-posts', 'PostsController@trashedPosts')->name('trashedPosts.index');

    // ======== route for trashed-posts restore posts
    Route::get('/trashed-posts/{id}', 'PostsController@restoreTrashed')->name('trashedPosts.restore');

    // ======== route for showing trashed-post
    Route::get('/trashed-post/{id}', 'PostsController@showTrashedPost')->name('trashedPosts.showTrashedPost');

    // ======== route for restore requests trashed-posts posts
    Route::get('/request-restore/trashed-posts', 'PostsController@requestsTrashedPosts')->name('requestsTrashedPosts.index');

    // ======== route for requesting to restore post
    Route::get('/request-to-restore-post/{id}', 'PostsController@requestToRestorePost')->name('requestToRestoreTrashedPosts.requestToRestorePost');

    // ======== route for requesting to restore post
    Route::get('/chancel-request-to-restore-post/{id}', 'PostsController@chancelRequestToRestorePost')->name('chancelRequestToRestoreTrashedPosts.chancelRequestToRestorePost');
});

// ##### this group of routes have relations with middlewares >>> auth , admin
Route::middleware(['auth', 'admin'])->group(function (){
    Route::get('/homeAdminDash', 'DashboardController@index')->name('dashboard.index');
    Route::get('/users', 'UsersController@index')->name('users.index');
    Route::get('/contact-us/messages', 'FrontEnd\ContactController@getMessages')->name('contactUs.messages');
    Route::get('/contact-us/messages/{id}', 'FrontEnd\ContactController@showMessage')->name('contactUs.showMessage');
    Route::get('/contact-us/messages/{id}/delete', 'FrontEnd\ContactController@deleteMessage')->name('contactUs.deleteMessage');
    Route::post('/users/{user}/make-admin','UsersController@makeAdmin')->name('users.make-admin');
    Route::post('/users/{user}/make-writer','UsersController@makeWriter')->name('users.make-writer');
});

// ######### routes must auth from the middleware 'auth' #########
Route::middleware(['auth'])->group(function (){
    Route::get('users/{user}/profile','UsersController@edit')->name('users.profileEdit');
    Route::post('users/{user}/profile','UsersController@update')->name('users.profileUpdate');
    Route::get('/my-posts','PostsController@myPosts')->name('myPosts.index');
    Route::get('/my-trashed-posts','PostsController@myTrashedPosts')->name('myTrashedPosts.index');
});

// ######### frontEnd routes #########
Route::namespace('FrontEnd')->group(function (){
    Route::get('/blogs', 'BlogController@index')->name('blogs.index');
    Route::get('/blogs/search-result', 'BlogController@search')->name('blogs.search');
    Route::get('/category-blogs/{catID}', 'BlogController@categoryBlogs')->name('category-blogs');
    Route::get('/tag-blogs/{tagID}', 'BlogController@tagBlogs')->name('tag-blogs');
    Route::get('/blog/{id}', 'BlogController@show')->name('blog.show');
    Route::get('/writer/{writerID}', 'WriterController@show')->name('writer.data');
    Route::get('/contact-us', 'ContactController@index')->name('contact.index');
    Route::post('/contact-us/store', 'ContactController@store')->name('contactUs.store');
});

//Route::get('/email', 'PostsController@sendEmail');

//Route::get('/getLastPostOfUser' , 'PostsController@getLastPostOfUser');
