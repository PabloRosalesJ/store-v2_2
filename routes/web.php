<?php

use App\Models\IncomeDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/','HomeController@index')->name('root');

Route::view('/test', 'test');


Auth::routes();

Route::prefix('category')->group(function () {
    Route::get('/', 'CategoryController@index')->name('category.index');
    Route::post('/', 'CategoryController@store')->name('category.store');
    Route::get('/{id}/show', 'CategoryController@show')->name('category.show');
    Route::put('/{id}/update', 'CategoryController@update')->name('category.update');
    Route::delete('/{id}/destroy', 'CategoryController@destroy')->name('category.destroy');
    Route::put('/{id}/disable', 'CategoryController@disable')->name('category.disable');
    Route::put('/{id}/enable', 'CategoryController@enable')->name('category.enable');
    Route::get('/search/{query}', 'CategoryController@search')->name('category.search');
});

Route::prefix('product')->group(function () {
    Route::get('/', 'ProductController@index')->name('product.index');
    Route::post('/', 'ProductController@store')->name('product.store');
    Route::get('/{id}/show', 'ProductController@show')->name('product.show');
    Route::put('/{id}/update', 'ProductController@update')->name('product.update');
    Route::put('/{id}/enable', 'ProductController@enableProduct')->name('product.enable');
    Route::put('/{id}/disable', 'ProductController@disableProduct')->name('product.disable');
    Route::delete('/{id}/destroy', 'ProductController@destroy')->name('product.destroy');
    Route::get('/search/{query}', 'ProductController@search')->name('product.search');
});

Route::prefix('person')->group(function () {
    Route::get('/', 'PersonController@index')->name('person.index');
    Route::post('/', 'PersonController@store')->name('person.store');
    Route::get('/{id}/show', 'PersonController@show')->name('person.show');
    Route::put('/{id}/update', 'PersonController@update')->name('person.update');
    Route::put('/{id}/enable', 'PersonController@enablePerson')->name('person.enable');
    Route::put('/{id}/disable', 'PersonController@disablePerson')->name('person.disable');
    Route::delete('/{id}/destroy', 'PersonController@destroy')->name('person.destroy');
    Route::get('/search/{query}', 'PersonController@search')->name('person.search');
});

Route::prefix('provider')->group(function () {
    Route::get('/', 'ProviderController@index')->name('provider.index');
    Route::post('/', 'ProviderController@store')->name('provider.store');
    Route::get('/{id}/show', 'ProviderController@show')->name('provider.show');
    Route::put('/{id}/update', 'ProviderController@update')->name('provider.update');
    Route::delete('/{id}/destroy', 'ProviderController@destroy')->name('provider.destroy');
    Route::get('/search/{query}', 'ProviderController@search')->name('provider.search');
});

Route::prefix('user')->group(function () {
    Route::get('/', 'UserController@index')->name('user.index');
    Route::post('/', 'UserController@store')->name('user.store');
    Route::get('/{id}/show', 'UserController@show')->name('user.show');
    Route::put('/{id}/update', 'UserController@update')->name('user.update');
    Route::delete('/{id}/destroy', 'UserController@destroy')->name('user.destroy');
    Route::get('/search/{query}', 'UserController@search')->name('user.search');
});

Route::prefix('rol')->group(function () {
    Route::get('/', 'RolController')->name('rol');
});

Route::prefix('income')->group(function () {
    Route::get('/', 'IncomeController@index')->name('income.index');
    Route::post('/', 'IncomeController@store')->name('income.store');
    Route::get('/{id}/show', 'IncomeController@show')->name('income.show');
    Route::put('/{id}/update', 'IncomeController@update')->name('income.update');
    Route::put('/{id}/disable', 'IncomeController@disable')->name('income.disable');
    Route::get('/search/{query}', 'IncomeController@search')->name('income.search');
});

Route::prefix('sale')->group(function () {
    Route::get('/', 'SaleController@index')->name('sale.index');
    Route::post('/', 'SaleController@store')->name('sale.store');
    Route::get('/{id}/details', 'SaleController@show')->name('sale.show');
    Route::put('/{id}/disable', 'SaleController@disable')->name('sale.disable');
    Route::get('/search/{query}', 'SaleController@search')->name('sale.search');
});

Route::prefix('credit')->group(function () {
    Route::get('/', 'CreditController@index')->name('credit.index');
    Route::post('/', 'CreditController@store')->name('credit.store');
    Route::get('/{credit_id}/details', 'CreditController@show')->name('credit.show');
    Route::put('/{credit_id}/disable', 'CreditController@disable')->name('credit.disable');
    Route::get('/search/', 'CreditController@search')->name('credit.search');
});
