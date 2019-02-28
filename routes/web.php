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
    return view('welcome');
});

Route::group(['prefix' => 'admin', 'middleware' => 'auth'], function() {
  Route::get('news/create', 'Admin\NewsController@add')->middleware('auth');
  Route::post('news/create', 'Admin\NewsController@create')->middleware('auth');
  Route::get('news', 'Admin\NewsController@index')->middleware('auth');
  Route::get('news/edit', 'Admin\NewsController@edit')->middleware('auth');
  Route::post('news/edit', 'Admin\NewsController@update')->middleware('auth');
  Route::get('news/delete', 'Admin\NewsController@delete')->middleware('auth');
  Route::get('profile/create', 'Admin\ProfileController@add')->middleware('auth');
  Route::post('profile/create', 'Admin\ProfileController@create')->middleware('auth');
  Route::get('profile/edit', 'Admin\ProfileController@edit')->middleware('auth');
  Route::post('profile/edit', 'Admin\ProfileController@update')->middleware('auth');
  Route::get('profile', 'Admin\ProfileController@index')->middleware('auth');
  Route::get('profile/delete', 'Admin\ProfileController@delete')->middleware('auth');

});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/', 'NewsController@index');
Route::post('/index', 'NewsController@index');

Route::post('/human','NewsController@indexhuman');
Route::post('/food','NewsController@indexfood');

Route::get('profile', 'NewsController@profile');
Route::post('/comment', 'CommentController@create');
Route::get('/comment', 'CommentController@delete');


Route::post('/posts/{post}/likes/create', 'LikesController@store');
Route::post('/posts/{post}/likes/destroy/{like}', 'LikesController@destroy');
