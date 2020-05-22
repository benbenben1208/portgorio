<?php


// Google認証ログイン　登録関連
Route::prefix('login')->name('login.')->group(function () {
  Route::get('/{provider}', 'Auth\LoginController@redirectToProvider')->name('{provider}');
  Route::get('/{provider}/callback', 'Auth\LoginController@handleProviderCallback')->name('{provider}.callback');
});
Route::prefix('register')->name('register.')->group(function () {
  Route::get('/{provider}', 'Auth\RegisterController@showProviderUserRegistrationForm')->name('{provider}');
  Route::post('/{provider}', 'Auth\RegisterController@registerProviderUser');
});



Auth::routes();


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
    //投稿管理
    Route::get('posts/index', 'Admin\UserPostController@index')->name('posts.index');
    Route::delete('posts/{post}/destroy', 'Admin\UserPostController@destroy')->name('posts.destroy');
    //ユーザーコメント管理
    Route::get('comments/index', 'Admin\UserCommentController@index')->name('comments.index');
    Route::delete('comments/{comment}/destroy', 'Admin\UserCommentController@destroy')->name('comments.destroy');
    
  });
});

//ユーザーページ関連
Route::prefix('/users')->name('users.')->group(function (){
  Route::get('/{user}', 'UserController@show')->name('show');
  Route::get('/{user}/edit', 'UserController@edit')->name('edit')->middleware('auth');
  Route::patch('/{user}/update', 'UserController@update')->name('update')->middleware('auth');
});
// 投稿一覧関連
Route::get('/', 'PostController@index')->name('posts.index');
Route::resource('posts','PostController')->except('index', 'show')->middleware('auth');
Route::resource('posts', 'PostController@show')->only('show');
// いいね機能関連
Route::put('posts/{post}/like' , 'PostController@like')->name('posts.like')->middleware('auth');
Route::delete('posts/{post}/like' , 'PostController@unlike')->name('posts.unlike')->middleware('auth');
// フォロー機能関連
Route::put('users/{name}/follow', 'UserController@follow')->name('users.follow')->middleware('auth');
Route::delete('users/{name}/follow', 'UserController@unfollow')->name('users.unfollow')->middleware('auth');

//ここからコメント機能のルーティング
Route::prefix('/comments')->name('comments.')->middleware('auth')->group(function (){
  Route::post('/', 'CommentController@store')->name('store');
// Route::post('comments/','CommentController@store')->name('comments.store');
  Route::delete('/{comment}', 'CommentController@destroy')->name('destroy');
});

Route::get('tags/{name}', 'TagController@show')->name('tags.show');



