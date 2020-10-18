<?php

use App\Models\IncomeDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/','HomeController@index')->name('root');

Route::view('/test', 'test');


Auth::routes();
