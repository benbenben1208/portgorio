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
Route::prefix('login')->name('login.')->group(function () {
  Route::get('/{provider}', 'Auth\LoginController@redirectToProvider')->name('{provider}');
  Route::get('/{provider}/callback', 'Auth\LoginController@handleProviderCallback')->name('{provider}.callback');
});
Route::prefix('register')->name('register.')->group(function () {
  Route::get('/{provider}', 'Auth\RegisterController@showProviderUserRegistrationForm')->name('{provider}');
  Route::post('/{provider}', 'Auth\RegisterController@registerProviderUser');
});

Route::get('/', 'PostController@index')->name('posts.index');

Auth::routes();

Route::prefix('/users')->name('users.')->group(function (){
  Route::get('/{user}', 'UserController@show')->name('show');
  Route::get('/{user}/edit', 'UserController@edit')->name('edit');
  Route::patch('/{user}/update', 'UserController@update')->name('update');
});

Route::resource('posts','PostController')->except('index');

Route::put('posts/{post}/like' , 'PostController@like')->name('posts.like')->middleware('auth');
Route::delete('posts/{post}/like' , 'PostController@unlike')->name('posts.unlike')->middleware('auth');

Route::put('users/{name}/follow', 'UserController@follow')->name('users.follow')->middleware('auth');
Route::delete('users/{name}/follow', 'UserController@unfollow')->name('users.unfollow')->middleware('auth');