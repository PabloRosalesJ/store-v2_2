<?php

use Illuminate\Support\Facades\Route;



// Auth::routes();

Route::post('login', 'Auth\LoginController@login');

Route::get('login', function () {
    return view('auth.login');
});

// Route::get('/reports', 'TestReporter@index');
Route::get('/{any?}','HomeController@index')->name('root')->where('any','.*');

