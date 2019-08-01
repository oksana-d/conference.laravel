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

use App\Main;
Route::get('/', 'HomeController@index');
Route::post('checkExistsEmail', 'HomeController@checkExistsEmail');
Route::post('saveUserInfo', 'HomeController@saveUserInfo');
Route::post('updateUserInfo', 'HomeController@updateUserInfo');
Route::get('members', 'MembersController@index');
