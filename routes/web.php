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



// csvダウンロード機能
Route::get('csv/download_users', 'CsvDownloadController@download_users');
Route::get('csv/download_flozened', 'CsvDownloadController@download_flozened');

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
//タグ機能
Route::get('tags/{name}', 'TagController@show')->name('tags.show');

//チャット機能
Route::get('chats/{user}/show', 'ChatController@show')->name('chats.show');
Route::get('chats/{user}/{group}/show', 'ChatController@showIsChatted')->name('chats.showIsChatted');
Route::post('chats/store/{group}', 'ChatController@store')->name('chats.store');
Route::post('chats/delete/{chat}', 'ChatController@destroy')->name('chats.delete');
Route::get('chats/getdata/{group}', 'ChatController@getData')->name('chats.getData');


