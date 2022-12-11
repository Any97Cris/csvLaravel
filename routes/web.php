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


//Import CSV
Route::get('/{status?}',['uses' => 'HomeController@index']);

//Upload CSV
// Route::get('upload', ['uses' => 'HomeController@upload']);
// Route::post('upload', ['uses' => 'HomeController@uploadPost']);
// Route::get('read_csv', ['uses' => 'HomeController@readCsv']);
// Route::get('show_csv', ['uses' => 'HomeController@showCsv']);
