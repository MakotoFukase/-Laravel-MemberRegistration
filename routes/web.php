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
Route::get('member_list', 'MemberController@list_display');
Route::get('member_list/register', 'MemberController@register');
Route::post('member_list/register', 'MemberController@create');
Route::get('member_list/register/confirm', 'MemberController@confirm');