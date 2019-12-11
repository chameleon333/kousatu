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
    return redirect('articles');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('articles', 'ArticlesController@index')->name('articles.index');
Route::resource('users', 'UsersController',['only' => ['index', 'show']]);



#ログイン状態
Route::group(['middleware' => 'auth'], function() {
  //#ユーザ関連
  Route::resource('users', 'UsersController',['only' => ['edit', 'update']]);
  
  // フォロー/フォロー解除を追加
  Route::post('users/{user}/follow', 'UsersController@follow')->name('follow');
  Route::delete('users/{user}/unfollow', 'UsersController@unfollow')->name('unfollow');
  
  //投稿記事関連
  Route::resource('articles', 'ArticlesController',['only' => ['create', 'store', 'edit', 'update', 'destroy']]);

  //コメント関連
  Route::resource('comments', 'CommentsController', ['only' => ['store']]);

  //いいね関連
  Route::resource('favorites', 'FavoritesController', ['only' => ['store','destroy']]);
});

Route::get('articles/{article}', 'ArticlesController@show')->name('articles.show');
