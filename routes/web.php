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
Route::get('', 'UsersController@index');
Route::get('input', 'UsersController@input');
Route::post('input', 'UsersController@create');
Route::get('input/conf', 'UsersController@conf');
Route::get('input/conf/complete', 'UsersController@complete');

// CSV出力
Route::get('export', 'CsvController@export');
// CSV入力
Route::post('import', 'CsvController@import');   


// テスト
Route::get('test', 'CsvController@test');