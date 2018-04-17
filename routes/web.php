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




Route::group(['middleware' => 'prevent-back-history'],function(){
	Route::get('/', function () {
    	return view('welcome');
	});
    
	Auth::routes();

	Route::get('/home', 'HomeController@index')->name('home');
	Route::get('/home/search', 'HomeController@searchBook')->name('search.book');
	Route::get('/book/printbooks', 'BookController@printBooks')->name('books.print');
	Route::resource('/book', 'BookController');
	Route::post('/book/add', 'BookController@storeAndNew')->name('book.store.new');

	Route::match(['PUT', 'PATCH'], '/book/update/{id}', 'BookController@updateAndView')->name('book.update.view');

	Route::get('user/settings', 'UserController@viewUser')->name('view.user');
	Route::post('user/settings/updatepicture', 'UserController@updatePicture')->name('update.picture');
	Route::post('user/settings/updateinfo', 'UserController@updateInfo')->name('update.info');
	Route::match(['PUT', 'PATCH'], 'user/settings/{id}', 'UserController@updatePassword')->name('update.password');

});