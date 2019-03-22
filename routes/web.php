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


// 参考書
Route::get('hello', 'HelloController@index');
Route::post('hello', 'HelloController@post');


// 会員登録サイト
Route::get('list', 'CustomerController@list_display');
Route::get('list/input', 'CustomerController@input');
Route::post('list/input', 'CustomerController@create');
Route::get('list/input/complete', 'CustomerController@complete');