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

Route::get('/', 'PostController@index')->name('posts.index');

Auth::routes();

Route::prefix('/users')->name('users.')->group(function (){
  Route::get('/{user}', 'UserController@show')->name('show');
  Route::get('/{user}/edit', 'UserController@edit')->name('edit');
  Route::patch('/{user}/update', 'UserController@update')->name('update');
});

Route::resource('posts','PostController')->except('index');

