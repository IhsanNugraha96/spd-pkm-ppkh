<?php

use Illuminate\Support\Facades\Route;

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

//Routing register
Route::get('/register', 'App\Http\Controllers\RegisterController@index')->middleware('guest');
Route::post('/register', 'App\Http\Controllers\RegisterController@store')->name('register')->middleware('guest');

//Routing login
Route::get('/', 'App\Http\Controllers\AuthController@index')->middleware('guest');
Route::get('/login', 'App\Http\Controllers\AuthController@index')->name('auth.login');
Route::post('/authenticate', 'App\Http\Controllers\AuthController@authenticate')->name('authenticate')->middleware('guest');
Route::get('/logout', 'App\Http\Controllers\AuthController@logout')->name('auth.logout')->middleware('auth');

//Routing dashboard
Route::get('/dashboard', 'App\Http\Controllers\DashboardController@index')->name('dashboard')->middleware('auth');