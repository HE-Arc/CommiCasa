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

Route::post('/category/validate', [
    'as' => 'validateCategory',
    'uses' => 'CategoryController@validCategory'
]);

Route::get('/recipe', [
    'as' => 'listRecipe',
    'uses' => 'RecipeController@listRecipe'
]);

Route::get('/recipe/add', [
    'as' => 'addRecipe',
    'uses' => 'RecipeController@addRecipe'
]);

Route::get('/recipe/show', [
    'as' => 'showRecipe',
    'uses' => 'RecipeController@showRecipe'
]);

Route::post('/recipe/validate', [
    'as' => 'validateRecipe',
    'uses' => 'RecipeController@validRecipe'
]);
