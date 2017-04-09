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

      Route::post('/delete/{id}','UserController@delete')->name('user_delete');
   });
});