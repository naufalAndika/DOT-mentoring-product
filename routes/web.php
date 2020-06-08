<?php

use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

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

Route::redirect('/', '/products');

Route::prefix('products')->name('products.')->group(function () {
    Route::get('/', 'ProductController@index')->name('index');
    Route::get('/create', 'ProductController@create')->name('create');
    Route::get('/edit/{product}', 'ProductController@edit')->name('edit');
    Route::get('detail/{product}', 'ProductController@show')->name('show');

    Route::post('/', 'ProductController@store')->name('store');

    Route::delete('/{product}', 'ProductController@destroy')->name('destroy');

    Route::post('/{product}', 'ProductController@update')->name('update');
});
