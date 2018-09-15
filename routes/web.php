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
    return view('welcome');
});


// list all rows
Route::get('todo', 'TodoController@index');
// select one row
Route::get('todo/{id}', 'TodoController@show');

Route::post('todo', 'TodoController@create');

Route::put('todo/{id}', 'TodoController@update');

Route::delete('todo/{id}', 'TodoController@delete');


//Route::resource('todo', 'TodoController');