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
Route::get('/', [
    'as' => 'index',
    'uses' => 'HomeController@index'
])->name('home');
//Product Route
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
Route::post('/product/update', [
    'as' => 'updateProduct',
    'uses' => 'ProductController@updateProduct'
]);
Route::match(['get', 'post'], '/product/{id}', [
    'as' => 'editProduct',
    'uses' => 'ProductController@editProduct'
]);
Route::get('/product/delete/{id}', [
    'as' => 'deleteProduct',
    'uses' => 'ProductController@deleteProduct'
]);
Route::post('/delete', [
    'as' => 'deleteProductOnList',
    'uses' => 'ProductController@deleteProductOnList'
]);
//Shopping List
Route::get('/shopping', [
    'as' => 'listShopping',
    'uses' => 'ShoppingController@listShopping'
]);
Route::post('/shopping', [
    'as' => 'addShopping',
    'uses' => 'ShoppingController@addShopping'
]);
Route::post('/shopping/recipe', [
    'as' => 'addRecipeShopping',
    'uses' => 'ShoppingController@addRecipeShopping'
]);
Route::post('/deleteShopping', [
    'as' => 'deleteShopping',
    'uses' => 'ShoppingController@deleteShopping'
]);
//Categories Route
Route::get('/category', [
    'as' => 'listCategory',
    'uses' => 'CategoryController@listCategory'
]);
Route::get('/category/add', [
    'as' => 'addCategory',
    'uses' => 'CategoryController@addCategory'
]);
Route::match(['get', 'post'], '/category/update/{id}', [
    'as' => 'updateCategory',
    'uses' => 'CategoryController@updateCategory'
]);
Route::post('/category/delete/{id}', [
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
//Recipes Route
Route::get('/recipe', [
    'as' => 'listRecipe',
    'uses' => 'RecipeController@listRecipe'
]);
Route::get('/recipe/add', [
    'as' => 'addRecipe',
    'uses' => 'RecipeController@addRecipe'
]);
Route::post('/recipe/validate', [
    'as' => 'validateRecipe',
    'uses' => 'RecipeController@validRecipe'
]);
Route::match(['get', 'post'], '/recipe/{id}', [
    'as' => 'editRecipe',
    'uses' => 'RecipeController@editRecipe'
]);
Route::get('/recipe/delete/{id}', [
    'as' => 'deleteRecipeList',
    'uses' => 'RecipeController@deleteRecipeList'
]);
Route::post('/recipe/{idRecipeList}/delete/{idRecipe}', [
    'as' => 'deleteRecipe',
    'uses' => 'RecipeController@deleteRecipe'
]);