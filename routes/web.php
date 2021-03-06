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

Route::get('/', 'HomeController@index');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('download/{file}', 'HomeController@download');

Route::post('upload', 'HomeController@upload');
Route::get('files/{email}', 'HomeController@files');
Route::get('assign/{id}', 'HomeController@assignRole');
Route::get('revoke/{id}', 'HomeController@revokeRole');
