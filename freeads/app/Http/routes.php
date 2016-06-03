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

Route::get('/', 'IndexController@showIndex');

Route::get('register', 'UserController@create');
Route::get('register/{token}', 'UserController@activate');
Route::post('register', 'UserController@store');

Route::get('login', 'UserController@showLogin');
Route::post('login', 'UserController@authenticate');

Route::get('home', 'IndexController@showIndex');

Route::get('user/logout', 'UserController@logout');

Route::get('user/edit', 'UserController@edit');
Route::post('user/edit', 'UserController@update');

Route::get('post/create', 'PostController@create');
Route::post('post/create', 'PostController@store');

Route::get('post/myposts', 'PostController@showMyposts');

Route::get('post/{id}', 'PostController@showPost');
Route::post('post/{id}', 'PostController@handleMyPost');

Route::any('search', 'PostController@handleSearch');

Route::get('user/message', 'UserController@showMessage');
Route::post('user/message', 'UserController@sendMessage');


