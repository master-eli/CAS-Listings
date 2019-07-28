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

Auth::routes();

Route::get('/', 'HomeController@index')->name('index');
Route::get('/counter', 'HomeController@counter')->name('counter');
Route::resource('/listings', 'ListingsController');
Route::get('/condemn', 'ListingsController@condemn')->name('condemn');
Route::get('/search', 'ListingsController@search')->name('search');
Route::get('/searchC', 'ListingsController@searchC')->name('searchC');
Route::get('/addDept', 'DepartmentController@addDept')->name('addDept');
Route::post('/storeDept', 'DepartmentController@storeDept')->name('storeDept');

