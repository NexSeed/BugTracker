<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/



 Route::get('/', 'WelcomeController@index');
 Route::get('/top', 'WelcomeController@index');

// ArticlesController 順番に注意
// Route::get('articles', 'ArticlesController@index');
// Route::get('articles/create', 'ArticlesController@create'); // ①
// Route::get('articles/{id}', 'ArticlesController@show');

// Route::post('articles','ArticlesController@store');
// Route::get('articles/{id}/edit', 'ArticlesController@edit');
// Route::patch('articles/{id}', 'ArticlesController@update');
// Route::delete('articles/{id}', 'ArticlesController@destroy');

Route::resource('articles','ArticlesController');  //resouce 書くと勝手に7つのRest fulのメソッドのルートを書いてくれる。 第一引数がarticlesの名前に{}の中に入る変数名は連動する
Route::post('/articles/deleteImage/{articles}/{image_num}','ArticlesController@deleteImage');
// Route::post('articles/like', 'ArticlesController@like');
// Route::get('articleslist', 'ArticlesController@listing');
// Route::get('articleslist/{section}', 'ArticlesController@selectlisting');

//Route::controller('hoge','hogeController1');

// 認証系
Route::controller('auth','Auth\AuthController');
Route::controller('password','Auth\PasswordController');

Route::resource('articles/comment','CommentsController');
Route::post('articles/comment/{article_id}/add','CommentsController@store');
Route::post('articles/comment/{comment_id}/delete', 'CommentsController@destroy');

Route::post('articles/{articles}/like','LikesController@store');
Route::post('articles/{articles}/unlike', 'LikesController@destroy');

// Route::get('test','CommentsController@test');

Route::get('/articleslist/Status/{status}/System/{system}', 'ArticlesController@limitByStatusAndSystem');








