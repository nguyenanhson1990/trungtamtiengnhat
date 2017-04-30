<?php
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
Route::group(['namespace' => 'Admin','middleware' => ['web']], function () {
   Route::get('/','IndexController@index')->name('login');
   Route::get('/home', 'IndexController@home')->name('home')->middleware('checkAuth');

   Route::post('/loginprocess', 'IndexController@loginProcess')->name('loginProcess');
   Route::get('/logout', 'IndexController@logout')->name('logout');

   Route::group(['prefix' => 'users', 'middleware' => ['checkAuth']], function (){
      Route::get('/','UserController@index')->name('users');
      Route::get('/create','UserController@create')->name('create');
      Route::post('/store','UserController@store')->name('store');

      Route::get('/edit/{id}','UserController@edit')->name('user_edit');
      Route::post('/update/{id}','UserController@update')->name('user_update');

      Route::post('/delete/{id}','UserController@destroy')->name('user_destroy');
      Route::get('/delete/getform','UserController@builform')->name('user_delete_form');
   });

   Route::group(['prefix' => 'categories', 'middleware' => ['checkAuth']], function (){
      Route::get('/','CategoriesController@index')->name('categories');
      Route::get('/create','CategoriesController@create')->name('category_create');
      Route::post('/store','CategoriesController@store')->name('category_store');

      Route::get('/edit/{id}','CategoriesController@edit')->name('category_edit');
      Route::post('/update/{id}','CategoriesController@update')->name('category_update');

      Route::get('/delete/getform','CategoriesController@builform')->name('category_delete_form');
      Route::post('/delete','CategoriesController@destroy')->name('category_destroy');
   });

   Route::group(['prefix' => 'contents', 'middleware' => ['checkAuth']], function (){
      Route::get('/pages','ContentsController@page_index')->name('contents_page');
      Route::get('/create','ContentsController@create')->name('contents_create');
      Route::post('/store','ContentsController@store')->name('contents_store');

      Route::get('/edit/{id}','ContentsController@edit')->name('contents_edit');
      Route::post('/update/{id}','ContentsController@update')->name('contents_update');

      Route::get('/delete/getform','ContentsController@builform')->name('contents_delete_form');
      Route::post('/delete','ContentsController@destroy')->name('contents_destroy');
   });
});