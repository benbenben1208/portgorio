<?php
Route::prefix('/admin')->name('admin.')->group(function () {
  //ホーム画面
  Route::get('home', 'Admin\HomeController@index')->name('home');
  
  //ログイン　ログアウト
  Route::get('login', 'Admin\Auth\LoginController@showLoginForm')->name('login');
  Route::post('login', 'Admin\Auth\LoginController@login')->name('login');
  Route::post('logout', 'Admin\Auth\LoginController@logout')->name('logout');

  //登録
  Route::get('register', 'Admin\Auth\RegisterController@showRegisterForm')->name('register');
  Route::post('register', 'Admin\Auth\RegisterController@register')->name('register');
  
  Route::middleware('auth:admin')->group(function () {
    //ユーザー管理
    Route::get('users/index', 'Admin\UserController@index')->name('users.index');
    Route::get('users/{user}/show', 'Admin\UserController@show')->name('users.show');
    Route::delete('users/{user}/destroy', 'Admin\UserController@destroy')->name('users.destroy');
    //凍結済みユーザー管理
    Route::get('flozened/index', 'Admin\FlozenedController@index')->name('flozened.index');
    Route::post('flozened/{flozened}/restore', 'Admin\FlozenedController@restore')->name('flozened.restore');
   
    //投稿管理
    Route::get('posts/index', 'Admin\UserPostController@index')->name('posts.index');
    Route::post('posts/index', 'Admin\UserPostController@index')->name('posts.search');
    Route::delete('posts/{post}/destroy', 'Admin\UserPostController@destroy')->name('posts.destroy');
    //ユーザーコメント管理
    Route::get('comments/index', 'Admin\UserCommentController@index')->name('comments.index');
    Route::post('comments/index', 'Admin\UserCommentController@index')->name('comments.search');
    Route::delete('comments/{comment}/destroy', 'Admin\UserCommentController@destroy')->name('comments.destroy');
    
  });
});