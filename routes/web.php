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


Auth::routes();

Route::get('logout', 'Auth\LoginController@logout');

Route::match(['get','post'], 'register', function (){
    return redirect('/');
});

Route::prefix('admin')->group(function ($id){
    Route::get('/', 'AdminController@index');
    Route::put('/changeUserInfo/{id}', 'AdminController@changeUserInfo');
});
