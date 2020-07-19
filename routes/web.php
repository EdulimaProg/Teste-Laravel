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

//Route for start page, Category page, Video register page
Route::get('/index', 'VideoController@index');

Route::get('/video/add', 'VideoController@add');

//to video view screen
Route::get('/video/view/{id}', 'VideoController@toViewVideo');

//save new video to list
Route::get('/video/save', 'VideoController@save')->name('save');

//list all comentary
Route::get('/comentary/list/{id}', 'VideoController@listComentary')->name('list');
//list all comentary
Route::post('/comentary/add', 'VideoController@addComentary')->name('add-comentary');

//Routes for Category update, delete and register
Route::get('/category/list', 'CategoriaController@listar')->name('list');

//list videos on favorites category
Route::get('/category/favorite/list/{id}', 'CategoriaController@toFavoriteCategory')->name('list-favorite');

//to category page
Route::get('/category/{category}', 'CategoriaController@toCategoryList')->name('to-category');
//Save Category
Route::post('/category/register', 'CategoriaController@cadastro')->name('save-category');

