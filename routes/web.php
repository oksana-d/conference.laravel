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
Route::get('/', 'MainController@index');
Route::post('checkExistsEmail', 'MainController@checkExistsEmail');
Route::post('saveUserInfo', 'MainController@saveUserInfo');
Route::post('updateUserInfo', 'MainController@updateUserInfo');
