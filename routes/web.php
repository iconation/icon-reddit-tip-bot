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

// OAuth Routes
Route::get('login/{provider}', 'Auth\LoginController@redirectToProvider')->name('reddit.login');
Route::get('auth/{provider}/callback', 'Auth\LoginController@handleProviderCallback');

Route::get('/', function () {
    return view('welcome');
})->name('home');

//User routes
Route::get('/dashboard','UserController@home')->name('dashboard');
Route::get('/dashboard/logout','UserController@logout')->name('user.logout');

Route::get('/address/create','AddressController@createAddress');
