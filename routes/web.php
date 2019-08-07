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

Route::get('/', 'UserController@index');
Route::post('saveUserInfo', 'UserController@saveUserInfo');
Route::post('updateUserInfo', 'UserController@updateUserInfo');
Route::get('members', 'MembersController@index');


Auth::routes(['register' => false]);

Route::get('logout', 'Auth\LoginController@logout');

Route::prefix('admin')->group(function ($id){
    Route::get('/', 'Auth\LoginController@showLoginForm')->name('admin');
    Route::post('/', 'Auth\LoginController@login');
    Route::get('/members', 'AdminController@index');
    Route::put('/changeUserInfo/{id}', 'AdminController@changeUserInfo');
});
