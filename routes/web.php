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

Route::get('/', 'HomeController@index')->name('home');

Route::get('logout', 'HomeController@logout')->name('logout');

Route::middleware(['auth'])->group(function () {
    Route::prefix('categorias')->group(function () {
        Route::get('', 'CategoryController@index')->name('categories.index');
        Route::get('novo', 'CategoryController@create')->name('categories.create');
        Route::post('', 'CategoryController@store')->name('categories.store');
        Route::get('{id}', 'CategoryController@edit')->name('categories.edit');
        Route::put('{id}', 'CategoryController@update')->name('categories.update');
        Route::delete('{id}', 'CategoryController@destroy')->name('categories.destroy');
    });

    Route::prefix('publicacoes')->group(function () {
        Route::get('', 'PostController@index')->name('posts.index');
        Route::get('novo', 'PostController@create')->name('posts.create');
        Route::post('', 'PostController@store')->name('posts.store');
        Route::get('{id}', 'PostController@edit')->name('posts.edit');
        Route::put('{id}', 'PostController@update')->name('posts.update');
        Route::delete('{id}', 'PostController@destroy')->name('posts.destroy');
    });
});

Auth::routes();
