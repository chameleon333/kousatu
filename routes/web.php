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
    return view('welcome');  
});

Route::resource('articles', 'ArticlesController');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');


#ログイン状態
Route::group(['middleware' => 'auth'], function() {
  #ユーザ関連
  Route::resource('users', 'UsersController',['only' => ['index', 'show', 'edit', 'update']]);
  
  Route::post('users/{user}/follow', 'UsersController@follow')->name('follow');
  Route::delete('users/{user}/unfollow', 'UsersController@unfollow')->name('unfollow');
  
});