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

Route::get('/',['as'=>'root','uses'=>'HomeController@index']);
Route::get('/home',['as'=>'home','uses'=>'HomeController@index']);
Route::get('/dashboard',['as'=>'dashboard','uses'=>"DashBoardController@index"]);

Route::get('/users',['as'=>'users','uses'=>"UserController@getList"]);
Route::get('/take',['as'=>'take','uses'=>"UserController@takeBook"]);
Route::get('/return',['as'=>'return','uses'=>"UserController@returnBook"]);
Route::get('/user/edit',['as'=>'edit_user','uses'=>"UserController@edit"]);
Route::get('/user/create',['as'=>'create_user','uses'=>"UserController@create"]);
Route::post('/user/save',['as'=>'save_user','uses'=>"UserController@save"]);
Route::get('/user/delete',['as'=>'delete_user','uses'=>"UserController@delete"]);

Route::get('/book/edit',['as'=>'edit_book','uses'=>"BookController@edit"]);
Route::get('/book/create',['as'=>'create_book','uses'=>"BookController@create"]);
Route::post('/book/save',['as'=>'save_book','uses'=>"BookController@save"]);
Route::get('/book/delete',['as'=>'delete_book','uses'=>"BookController@delete"]);
Route::get('/books',['as'=>'books','uses'=>"BookController@getList"]);

Route::get('login/{provider?}', 'Auth\AuthController@login');
Route::controller('/','Auth\AuthController');
