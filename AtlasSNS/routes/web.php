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

Route::get('/register', 'Auth\RegisterController@register');
Route::post('/register', 'Auth\RegisterController@register');

Route::get('/added', 'Auth\RegisterController@added');
Route::post('/added', 'Auth\RegisterController@added');

//ログイン中のページ
Route::middleware('auth')->group(function() {
    Route::get('/top','PostsController@index')->name('top');

    Route::get('/profile','UsersController@profile')->name('profile');

    Route::get('/search','UsersController@index')->name('search');

    Route::get('/follow-list','PostsController@index')->name('follow');
    Route::get('/follower-list','PostsController@index')->name('follower');
});