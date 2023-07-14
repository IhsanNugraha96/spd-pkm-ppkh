<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ParticipantsController;
use App\Http\Controllers\FamilyController;
use App\Http\Controllers\IndikatorController;
use App\Http\Controllers\LocationController;
use App\Http\Controllers\PictureController;
use App\Http\Controllers\KelompokController;

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
    Route::get('/getKetuaKelompok', [UsersController::class, 'getKetuaKelompok'])->name('user.getKetuaKelompok')->middleware('auth');
    // Route::get('/users-login', [UserController::class, 'usersLogin'])->name('user.login');
});

#DATAS
// Participants
Route::prefix('participants')->group(function() {
    Route::get('/', [ParticipantsController::class, 'index'])->name('participants')->middleware('auth');
    Route::get('/form-add', [ParticipantsController::class, 'viewFormAdd'])->name('participant.form-add')->middleware('auth');
    Route::get('/getById', [ParticipantsController::class, 'getParticipantById'])->name('participant.getById')->middleware('auth');
    Route::get('/view-detail', [ParticipantsController::class, 'viewDetail'])->name('participant.view-detail')->middleware('auth');
    Route::post('/add',[ParticipantsController::class, 'insert'])->name('participant.add')->middleware('auth');
    Route::put('/update', [ParticipantsController::class, 'edit'])->name('participant.edit')->middleware('auth');
    Route::delete('/delete', [ParticipantsController::class, 'delete'])->name('participant.delete')->middleware('auth');
    Route::get('/getById', [ParticipantsController::class, 'getParticipantById'])->name('participant.getById')->middleware('auth');
});

// Location
Route::get('kota', [LocationController::class, 'getListKotaByProv'])->name('list-kota.prov')->middleware('auth');
Route::get('kecamatan', [LocationController::class, 'getListKecamatanByKota'])->name('list-kec.kota')->middleware('auth');
Route::get('kelurahan', [LocationController::class, 'getListKelurahanByKec'])->name('list-kel.kec')->middleware('auth');

// Family
Route::prefix('family')->group(function() {
    Route::post('/add', [FamilyController::class, 'index'])->name('family.add')->middleware('auth');
    Route::put('/update', [FamilyController::class, 'update'])->name('family.update')->middleware('auth');
    Route::delete('/delete', [FamilyController::class, 'destroy'])->name('family.delete')->middleware('auth');
});

// Picture
Route::prefix('picture')->group(function() {
    Route::get('/download-profil/{filename}', [PictureController::class, 'downloadProfil'])->name('download.profil')->middleware('auth');
    Route::get('/download-home/{filename}', [PictureController::class, 'downloadHome'])->name('download.home')->middleware('auth');
    Route::post('/profil-upload',[PictureController::class, 'uploadProfil'])->name('profil-upload');
    Route::post('/home-upload',[PictureController::class, 'uploadHome'])->name('home-upload')->middleware('auth');
});

// Indikator
Route::put('indikator/update', [IndikatorController::class, 'update'])->name('indikator.update')->middleware('auth');

// Kelompok
Route::prefix('kelompok')->group(function() {
    Route::get('/', [KelompokController::class, 'index'])->name('kelompok')->middleware('auth');
    Route::post('/insert', [KelompokController::class, 'insert'])->name('kelompok.add')->middleware('auth');
    Route::put('/update',[KelompokController::class, 'update'])->name('kelompok.edit');
    Route::delete('/delete',[KelompokController::class, 'delete'])->name('kelompok.delete')->middleware('auth');
    Route::get('/id', [KelompokController::class, 'getById'])->name('kelompok.getById')->middleware('auth');
});