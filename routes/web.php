<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\AuthController;
// use App\Http\Controllers\ParticipantsController;
// use App\Http\Controllers\FamilyController;
// use App\Http\Controllers\IndikatorController;
// use App\Http\Controllers\LocationController;

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

#USER
Route::prefix('user')->group(function() {
    Route::get('/', [UsersController::class, 'index'])->name('user.index')->middleware('auth');
    Route::get('/get', [UsersController::class, 'get'])->name('user.get')->middleware('auth');    
    Route::post('/add', [UsersController::class, 'add'])->name('user.add')->middleware('auth');
    Route::put('/edit', [UsersController::class, 'edit'])->name('user.edit')->middleware('auth');
    Route::delete('/delete', [UsersController::class, 'destroy'])->name('user.delete')->middleware('auth');
    Route::get('/getById', [UsersController::class, 'getUserById'])->name('user.getById')->middleware('auth');
    // Route::get('/users-login', [UserController::class, 'usersLogin'])->name('user.login');
});