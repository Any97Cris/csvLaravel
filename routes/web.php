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

//Rota Padrão
// Route::get('/', function () {
//     return view('index');
// });

//Import CSV
Route::get('/download/{status?}',['uses' => 'HomeController@index']);

//Upload CSV
Route::get('upload', ['uses' => 'HomeController@upload']);
Route::post('upload', ['uses' => 'HomeController@uploadPost']);
Route::get('read_csv', ['uses' => 'HomeController@readCsv']);

//HTML
Route::get('show_csv', ['uses' => 'HomeController@showCsv']);

//XML
Route::get('readXml', ['uses' => 'HomeController@readXml']);

//JSON
Route::get('readJson', ['uses' => 'HomeController@readJson']);
