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

use Illuminate\Support\Facades\Mail;

Route::get('/', 'MainController@index');

Route::group(['middleware' => ['admin']], function () {
    Route::get('/admin', 'AdminController@index');
    Route::get('/admin/logout', 'AdminController@logout');
    Route::post('/admin/delete-file', 'AdminController@deleteFile');

    //Menu
    Route::get('/admin/menu', 'MenuController@index');
    Route::get('/admin/menu/create', 'MenuController@create');
    Route::post('/admin/menu', 'MenuController@store');
    Route::get('/admin/menu/{menu}/edit', 'MenuController@edit');
    Route::put('/admin/menu/{menu}', 'MenuController@update');
    Route::get('/admin/menu/{menu}/delete', 'MenuController@destroy');

    //Infoblocks
    Route::get('/admin/infoblocks', 'InfoblockController@index');
    Route::get('/admin/infoblocks/create', 'InfoblockController@create');
    Route::post('/admin/infoblocks', 'InfoblockController@store');
    Route::get('/admin/infoblocks/{infoblock}/edit', 'InfoblockController@edit');
    Route::put('/admin/infoblocks/{infoblock}', 'InfoblockController@update');
    Route::get('/admin/infoblocks/{infoblock}/delete', 'InfoblockController@destroy');

    //Services
    Route::get('/admin/services', 'ServiceController@index');
    Route::get('/admin/services/create', 'ServiceController@create');
    Route::post('/admin/services', 'ServiceController@store');
    Route::get('/admin/services/{service}/edit', 'ServiceController@edit');
    Route::put('/admin/services/{service}', 'ServiceController@update');
    Route::get('/admin/services/{service}/delete', 'ServiceController@destroy');

    //Reviews
    Route::get('/admin/reviews', 'ReviewController@index');
    Route::get('/admin/reviews/create', 'ReviewController@create');
    Route::post('/admin/reviews', 'ReviewController@store');
    Route::get('/admin/reviews/{review}/edit', 'ReviewController@edit');
    Route::put('/admin/reviews/{review}', 'ReviewController@update');
    Route::get('/admin/reviews/{review}/delete', 'ReviewController@destroy');

    //Gallery
    Route::get('/admin/gallery', 'GalleryController@index');
    Route::get('/admin/gallery/create', 'GalleryController@create');
    Route::post('/admin/gallery', 'GalleryController@store');
    Route::get('/admin/gallery/{image}/edit', 'GalleryController@edit');
    Route::put('/admin/gallery/{image}', 'GalleryController@update');
    Route::get('/admin/gallery/{image}/delete', 'GalleryController@destroy');
});

Route::post('/admin/login', 'AdminController@auth');
Route::get('/admin/login', 'AdminController@login');

//User
Route::group(['middleware' => ['auth']], function () {
    Route::get('/user/favorite', 'FavoriteController@index');
    Route::post('/user/{user}/favorite', 'FavoriteController@change');
});
Route::get('/user/sign-in', 'UserController@signIn');
Route::get('/user/sign-up', 'UserController@signUp');
Route::post('/user/sign-up', 'UserController@register');
Route::post('/user/sign-in', 'UserController@login')->name('login');
Route::get('/user/logout', 'UserController@logout');
Route::get('/user/email-confirmation', 'UserController@emailConfirmation');
Route::post('/user/reset-password', 'UserController@resetPassword');
Route::get('/user/settings', 'UserController@edit');
Route::put('/user/{user}', 'UserController@update');

//Books
Route::get('/user/{login}/books', 'BookController@userList');
Route::get('/books', 'BookController@list');

// TODO: add owning middleware
Route::group(['middleware' => ['auth']], function () {
    Route::get('/books/{book}/change-status', 'BookController@changeStatus');
    Route::get('/books/{book}/delete', 'BookController@delete');
    Route::get('/books/add', 'BookController@add');
    Route::post('/books', 'BookController@store');
    Route::get('/books/{book}/edit', 'BookController@edit');
    Route::put('/books/{book}', 'BookController@update');
    Route::post('/main/send-message', 'MainController@sendMessage');

    Route::group(['prefix' => 'user/messages'], function () {
        Route::get('/', ['as' => 'messages', 'uses' => 'MessagesController@index']);
        Route::get('create', ['as' => 'messages.create', 'uses' => 'MessagesController@create']);
        Route::post('/', ['as' => 'messages.store', 'uses' => 'MessagesController@store']);
        Route::get('{channel}', ['as' => 'messages.show', 'uses' => 'MessagesController@show']);
        Route::put('{channel}', ['as' => 'messages.update', 'uses' => 'MessagesController@update']);
    });
});

Route::post('/main/delete-file', 'MainController@deleteFile');
Route::post('/main/change-city', 'MainController@changeCity');
Route::post('/main/get-date', 'MainController@getDate');
Route::get('/books/{book}', 'BookController@view');


Route::get('/mailable', function () {
    $user = App\User::find(1);

    return new App\Mail\UserRegistration($user);
    //Mail::to('evmusonov@gmail.com')->send(new \App\Mail\UserRegistration());
});
