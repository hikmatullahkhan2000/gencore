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

Route::get('/', 'HomeController@index')->name('home');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('products/data', 'ProductsController@anyData')->name("products.data");
//Route::resource('products', 'ProductsController');

Route::get('/products', 'ProductsController@index')->name('products.index');
Route::get('products/create', 'ProductsController@create')->name('products.create');
Route::post('products/store', 'ProductsController@store')->name('products.store');
Route::get('products/edit/{id}', 'ProductsController@edit')->name('products.edit');
Route::match(['put', 'patch'],'products/update/{id}', 'ProductsController@update')->name('products.update');
Route::get('products/delete/{id}', 'ProductsController@destroy')->name('products.delete');
