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


Auth::routes();

Route::get('/home', 'CustomHomeController@index');
Route::get('/logout/user', 'CustomHomeController@logoutUser');

Route::post('/register/user', 'CustomSignupController@addUser');
Route::post('/login/user', 'CustomLoginController@loginUser');


