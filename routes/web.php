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

Route::get('/', ['uses' => 'App\Http\Controllers\HomeController@index', 'as' => 'home.index']);
Route::get('/product', ['uses' => 'App\Http\Controllers\HomeController@lists', 'as' => 'product']);
Route::get('/product/new', ['uses' => 'App\Http\Controllers\HomeController@news', 'as' => 'product.new']);
Route::get('/contact', ['uses' => 'App\Http\Controllers\HomeController@contact', 'as' => 'contact']);
Route::get('/category/{id}/produits', ['uses' => 'App\Http\Controllers\HomeController@showProduct', 'as' => 'category.produits']);

Route::get('/admin/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

Route::group(['middleware' => ['auth'], 'prefix' => 'admin', 'as' => 'admin.'], function () {
    Route::resource('/categories', 'App\Http\Controllers\CategoryController');
    Route::get('/category/activate/{id}', ['uses' => 'App\Http\Controllers\CategoryController@activate', 'as' => 'categories.activate']);
    Route::get('/category/deactivate/{id}', ['uses' => 'App\Http\Controllers\CategoryController@deactivate', 'as' => 'categories.deactivate']);
    Route::post('categories_mass_destroy', ['uses' => 'App\Http\Controllers\CategoryController@massDestroy', 'as' => 'categories.mass_destroy']);
    Route::post('categories_restore/{id}', ['uses' => 'App\Http\Controllers\CategoryController@restore', 'as' => 'categories.restore']);
    Route::delete('categories_perma_del/{id}', ['uses' => 'App\Http\Controllers\CategoryController@perma_del', 'as' => 'categories.perma_del']);


    Route::resource('/produits', 'App\Http\Controllers\ProduitController');
    Route::get('/produits/activate/{id}', ['uses' => 'App\Http\Controllers\ProduitController@activate', 'as' => 'produits.activate']);
    Route::get('/produits/deactivate/{id}', ['uses' => 'App\Http\Controllers\ProduitController@deactivate', 'as' => 'produits.deactivate']);
    Route::post('produits_mass_destroy', ['uses' => 'App\Http\Controllers\ProduitController@massDestroy', 'as' => 'produits.mass_destroy']);
    Route::post('produits_restore/{id}', ['uses' => 'App\Http\Controllers\ProduitController@restore', 'as' => 'produits.restore']);
    Route::delete('produits_perma_del/{id}', ['uses' => 'App\Http\Controllers\ProduitController@perma_del', 'as' => 'produits.perma_del']);


    Route::resource('/images', 'App\Http\Controllers\ImageController');
    Route::post('images_mass_destroy', ['uses' => 'App\Http\Controllers\ImageController@massDestroy', 'as' => 'images.mass_destroy']);
    Route::post('images_restore/{id}', ['uses' => 'App\Http\Controllers\ImageController@restore', 'as' => 'images.restore']);
    Route::delete('images_perma_del/{id}', ['uses' => 'App\Http\Controllers\ImageController@perma_del', 'as' => 'images.perma_del']);


    Route::resource('/users', 'App\Http\Controllers\UsersController');
    Route::get('/users/activate/{id}', ['uses' => 'App\Http\Controllers\UsersController@activate', 'as' => 'users.activate']);
    Route::get('/users/deactivate/{id}', ['uses' => 'App\Http\Controllers\UsersController@deactivate', 'as' => 'users.deactivate']);
    Route::post('users_mass_destroy', ['uses' => 'App\Http\Controllers\UsersController@massDestroy', 'as' => 'users.mass_destroy']);
    Route::post('users_restore/{id}', ['uses' => 'App\Http\Controllers\UsersController@restore', 'as' => 'users.restore']);
    Route::delete('users_perma_del/{id}', ['uses' => 'App\Http\Controllers\UsersController@perma_del', 'as' => 'users.perma_del']);


});

require __DIR__.'/auth.php';
