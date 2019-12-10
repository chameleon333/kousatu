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
    // return view('articles/index');  
    return redirect('articles');
});

//Route::resource('articles', 'ArticlesController');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::resource('articles', 'ArticlesController',['only' => ['index','show']]);
// Route::get('articles', 'ArticlesController@index');
// Route::get('articles/{article}/', 'ArticlesController@show');


#ログイン状態
Route::group(['middleware' => 'auth'], function() {
  //#ユーザ関連
  Route::resource('users', 'UsersController',['only' => ['index', 'show', 'edit', 'update']]);
  
  // フォロー/フォロー解除を追加
  Route::post('users/{user}/follow', 'UsersController@follow')->name('follow');
  Route::delete('users/{user}/unfollow', 'UsersController@unfollow')->name('unfollow');
  
  //投稿記事関連
  // Route::resource('articles', 'ArticlesController',['only' => ['index', 'create', 'store', 'show', 'edit', 'update', 'destroy']]);
  Route::resource('articles', 'ArticlesController',['only' => ['create', 'store', 'edit', 'update', 'destroy']]);

  //コメント関連
  Route::resource('comments', 'CommentsController', ['only' => ['store']]);

  //いいね関連
  Route::resource('favorites', 'FavoritesController', ['only' => ['store','destroy']]);
});