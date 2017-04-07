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
   Route::get('/home', 'IndexController@home')->name('home');

   Route::post('/loginprocess', 'IndexController@loginProcess')->name('loginProcess');
   Route::get('/logout', 'IndexController@logout')->name('logout');
});