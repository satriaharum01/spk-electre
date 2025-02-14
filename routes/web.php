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

Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('landing');

//Login
Route::get('/account/login', [App\Http\Controllers\HomeController::class, 'login'])->name('login');
Route::POST('/account/logout', [App\Http\Controllers\CustomAuth::class, 'customlogout'])->name('logout');
Route::POST('/account/set_password', [App\Http\Controllers\CustomAuth::class, 'set_password'])->name('set.password');
Route::POST('/account/login/cek_login', [App\Http\Controllers\CustomAuth::class, 'customLogin'])->name('custom.login');

//GET ADMIN

Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [App\Http\Controllers\AdminDashboardController::class, 'index'])->name('dashboard');
    Route::get('/alternatif', [App\Http\Controllers\AdminAlternatifController::class, 'index'])->name('alternatif');
    Route::get('/kriteria', [App\Http\Controllers\AdminKriteriaController::class, 'index'])->name('kriteria');
    Route::get('/penilaian', [App\Http\Controllers\AdminPenilaianController::class, 'index'])->name('penilaian');
    Route::get('/hasil', [App\Http\Controllers\AdminRangkingController::class, 'index'])->name('hasil');
    Route::get('/pengguna', [App\Http\Controllers\AdminPenggunaController::class, 'index'])->name('pengguna');
    Route::get('/profile', [App\Http\Controllers\AdminProfileController::class, 'index'])->name('profile');

    Route::prefix('dashboard')->name('dashboard.')->group(function () {
        Route::get('/json', [App\Http\Controllers\AdminDashboardController::class, 'json']);
        Route::get('/barChart', [App\Http\Controllers\AdminDashboardController::class, 'barChart']);
    });

    Route::prefix('alternatif')->name('alternatif.')->group(function () {
        Route::get('/tambah', [App\Http\Controllers\AdminAlternatifController::class, 'new'])->name('new');
        Route::get('/edit/{id}', [App\Http\Controllers\AdminAlternatifController::class, 'edit'])->name('edit');
        Route::POST('/save', [App\Http\Controllers\AdminAlternatifController::class, 'store']);
        Route::POST('/update/{id}', [App\Http\Controllers\AdminAlternatifController::class, 'update']);
        Route::GET('/delete/{id}', [App\Http\Controllers\AdminAlternatifController::class, 'destroy']);
        Route::get('/json', [App\Http\Controllers\AdminAlternatifController::class, 'json']);
        Route::get('/find/{id}', [App\Http\Controllers\AdminAlternatifController::class, 'find']);
    });

    Route::prefix('kriteria')->name('kriteria.')->group(function () {
        Route::get('/tambah', [App\Http\Controllers\AdminKriteriaController::class, 'new'])->name('new');
        Route::get('/edit/{id}', [App\Http\Controllers\AdminKriteriaController::class, 'edit'])->name('edit');
        Route::get('/detail/{id}', [App\Http\Controllers\AdminKriteriaController::class, 'detail'])->name('detail');
        Route::POST('/save', [App\Http\Controllers\AdminKriteriaController::class, 'store']);
        Route::POST('/update/{id}', [App\Http\Controllers\AdminKriteriaController::class, 'update']);
        Route::GET('/delete/{id}', [App\Http\Controllers\AdminKriteriaController::class, 'destroy']);
        Route::get('/json', [App\Http\Controllers\AdminKriteriaController::class, 'json']);
        Route::get('/find/{id}', [App\Http\Controllers\AdminKriteriaController::class, 'find']);
        //Sub Kriteria
        Route::POST('{od}/save', [App\Http\Controllers\AdminKriteriaController::class, 'store_sub']);
        Route::POST('{od}/update/{id}', [App\Http\Controllers\AdminKriteriaController::class, 'update_sub']);
        Route::GET('{od}/delete/{id}', [App\Http\Controllers\AdminKriteriaController::class, 'destroy_sub']);
        Route::get('{od}/json', [App\Http\Controllers\AdminKriteriaController::class, 'json_sub']);
        Route::get('{od}/find/{id}', [App\Http\Controllers\AdminKriteriaController::class, 'find_sub']);
    });

    Route::prefix('penilaian')->name('penilaian.')->group(function () {
        Route::get('/tambah', [App\Http\Controllers\AdminPenilaianController::class, 'new'])->name('new');
        Route::get('/edit/{id}', [App\Http\Controllers\AdminPenilaianController::class, 'edit'])->name('edit');
        Route::POST('/save', [App\Http\Controllers\AdminPenilaianController::class, 'store']);
        Route::POST('/update/{id}', [App\Http\Controllers\AdminPenilaianController::class, 'update']);
        Route::GET('/delete/{id}', [App\Http\Controllers\AdminPenilaianController::class, 'destroy']);
        Route::get('/json', [App\Http\Controllers\AdminPenilaianController::class, 'json']);
        Route::get('/find/{id}', [App\Http\Controllers\AdminPenilaianController::class, 'find']);
    });

    Route::prefix('hasil')->name('hasil.')->group(function () {
        Route::get('/json', [App\Http\Controllers\AdminRangkingController::class, 'hitungElectreLaravel'])->name('data');
    });

    Route::prefix('profile')->name('profile.')->group(function () {
        Route::POST('/update/{id}', [App\Http\Controllers\AdminProfileController::class, 'update']);
    });

    Route::prefix('pengguna')->name('pengguna.')->group(function () {
        Route::get('/tambah', [App\Http\Controllers\AdminPenggunaController::class, 'new'])->name('new');
        Route::get('/edit/{id}', [App\Http\Controllers\AdminPenggunaController::class, 'edit'])->name('edit');
        Route::POST('/save', [App\Http\Controllers\AdminPenggunaController::class, 'store']);
        Route::POST('/update/{id}', [App\Http\Controllers\AdminPenggunaController::class, 'update']);
        Route::GET('/delete/{id}', [App\Http\Controllers\AdminPenggunaController::class, 'destroy']);
        Route::get('/json', [App\Http\Controllers\AdminPenggunaController::class, 'json']);
        Route::get('/find/{id}', [App\Http\Controllers\AdminPenggunaController::class, 'find']);
    });
});
