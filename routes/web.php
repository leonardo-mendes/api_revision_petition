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

Route::get('/', function () {
    return view('home');
});

Auth::routes();

Route::get('/home', 'HomeController@getDashboard')->name('home');
Route::get('/question', 'HomeController@getQuestion')->name('question');
Route::get('/results/petition/{petition}', 'ResultController@getQuestion')->name('petition_results');