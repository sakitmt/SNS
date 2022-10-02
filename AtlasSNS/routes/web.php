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

// Route::get('/', function () {
//     return view('welcome');
// });
// Route::get('/home', 'HomeController@index')->name('home');

//Auth::routes();


//ログアウト中のページ
Route::get('/login', 'Auth\LoginController@login')->name('login');
//->name('login') ルーティングに'login'という名前をつけ、別のファイルからRoute('login')を指定した時に/loginに飛ぶように設定できる。
Route::post('/login', 'Auth\LoginController@login');
//ログイン画面

Route::get('/register', 'Auth\RegisterController@register')->name('register');
Route::post('/register', 'Auth\RegisterController@register');
//register=登録　registerControllerは新規登録について記載している。バリデーション機能も含む。正常に登録が完了したら↓addedに進む。

Route::get('/added', 'Auth\RegisterController@added');
Route::post('/added', 'Auth\RegisterController@added');
//登録完了のメッセージ画面

Route::get('/logout', 'Auth\LoginController@logout');
//ログアウト

//ログイン中のページ
Route::middleware('auth')->group(function() {
    Route::get('/top','PostsController@index')->name('top');
    Route::post('/top','PostsController@post')->name('posts');
    Route::post('/update','PostsController@update');
    Route::get('/post/{id}/delete','PostsController@delete');

    Route::get('/profile','UsersController@profile')->name('profile');

    Route::get('/search','UsersController@search')->name('search');

    Route::get('/follow-list','PostsController@index')->name('follow');
    Route::get('/follower-list','PostsController@index')->name('follower');
});


App::setLocale('ja');
//config/app.phpの内容を変更'locale' => 'ja',しても変わらず、ここで上記の宣言をしたら翻訳された