<?php

use Illuminate\Support\Facades\Route;


// Route::view('/users', 'user.user_index')->name('user.index');

Auth::routes();

// Route::get('/home', 'HomeController@index')->name('home');

Route::get('/','HomeController@index')->name('root');