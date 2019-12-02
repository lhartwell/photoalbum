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
    return view('auth.login');
});

Auth::routes();

Route::get('/user/list','UserController@index')->name('user.list');
Route::get('/home', 'HomeController@index')->name('home');
Route::get('/album/{id}', 'PhotosController@index')->name('photos.list');
Route::get('/photos/gallery/{id}', 'PhotosController@gallery')->name('photos.gallery');
Route::get('/photos/create/{id}', 'PhotosController@create')->name('photos.createupload');
Route::post('/photos','PhotosController@store')->name('photos.storeupload');
Route::post('/photos/store','PhotosController@store')->name('photos.store');
Route::resource('albums','AlbumsController');
Route::resource('user','UserController');
