<?php

use Illuminate\Support\Facades\Route;

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

Auth::routes();
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home')
    ->middleware('auth');

Route::get('/', 'App\Http\Controllers\PostsController@indexMain')->name('welcome');
Route::get('/articles', 'App\Http\Controllers\PostsController@index')->name('articles.index');
Route::post('/articles', 'App\Http\Controllers\PostsController@store');
Route::get('/articles/create', 'App\Http\Controllers\PostsController@create');
Route::get('/articles/{post}', 'App\Http\Controllers\PostsController@show')->name('articles.show');
Route::get('/articles/{post}/edit', 'App\Http\Controllers\PostsController@edit');
Route::put('/articles/{post}', 'App\Http\Controllers\PostsController@update');
Route::post('/articles/{post}', 'App\Http\Controllers\CommentsController@store',);
Route::get('/views', 'App\Http\Controllers\PostsController@numbViews');
Route::get('/likes', 'App\Http\Controllers\PostsController@numbLikes');
Route::get('/clicklike', 'App\Http\Controllers\PostsController@clickLikes');
Route::get('/aarticles', 'App\Http\Controllers\PostsController@indexAdmin')->middleware('auth');
Route::get('/aarticles/{post}/del', 'App\Http\Controllers\PostsController@destroy')->middleware('auth');
Route::get('/articles/{post}/novis', 'App\Http\Controllers\PostsController@novis')->middleware('auth');
Route::get('/acomments', 'App\Http\Controllers\CommentsController@indexAdmin')->middleware('auth');
Route::get('/acomments/{comment}/add', 'App\Http\Controllers\CommentsController@publicCom')->middleware('auth');
Route::get('/acomments/{comment}/del', 'App\Http\Controllers\CommentsController@destroy')->middleware('auth');
Route::get('/acategory', 'App\Http\Controllers\CategoresController@indexAdmin')->middleware('auth');
Route::get('/acategory/{category}/del', 'App\Http\Controllers\CategoresController@destroy')->middleware('auth');
Route::get('/acategory/{category}', 'App\Http\Controllers\CategoresController@indexAdmin')->middleware('auth');
Route::get('/acategory/{category}/edit', 'App\Http\Controllers\CategoresController@edit')->middleware('auth');
Route::put('/acategory/{category}', 'App\Http\Controllers\CategoresController@update');
