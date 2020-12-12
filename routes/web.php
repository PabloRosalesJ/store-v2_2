<?php

use Illuminate\Support\Facades\Route;


// Route::view('/users', 'user.user_index')->name('user.index');

Auth::routes();

// Route::get('/home', 'HomeController@index')->name('home');
// Route::get('report', function () {
//    // return view('reports.clients.shops');
//     $pdf = PDF::loadView('reports.clients.shops', []);
//     return $pdf->download('customer-list.pdf');
// });
Route::get('/reports', 'TestReporter@index');
Route::get('/{any?}','HomeController@index')->name('root')->where('any','.*');
Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
