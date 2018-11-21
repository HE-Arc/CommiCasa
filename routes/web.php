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

Route::get('/', 'HomeController@index')->name('home');

Route::get('/product', [
    'as' => 'listProduct',
    'uses' => 'ProductController@listProduct'
]);

Route::get('/product/add', [
    'as' => 'addProduct',
    'uses' => 'ProductController@addProduct'
]);

Route::post('/product/validate', [
    'as' => 'validateProduct',
    'uses' => 'ProductController@validProduct'
]);


Route::get('/category', [
    'as' => 'listCategory',
    'uses' => 'CategoryController@listCategory'
]);



Route::get('/category/add', [
    'as' => 'addCategory',
    'uses' => 'CategoryController@addCategory'
]);

Route::match(['get', 'post'],'/category/update/{id}', [
    'as' => 'updateCategory',
    'uses' => 'CategoryController@updateCategory'
]);


Route::get('/category/delete/{id}', [
    'as' => 'deleteCategory',
    'uses' => 'CategoryController@deleteCategory'
]);

Route::get('/category/show/{id}', [
    'as' => 'showCategory',
    'uses' => 'CategoryController@showCategory'
]);

Route::post('/category/create', [
    'as' => 'createCategory',
    'uses' => 'CategoryController@createCategory'
]);
