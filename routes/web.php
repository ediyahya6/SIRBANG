<?php

use App\Http\Controllers\WelcomeController;
use Illuminate\Support\Facades\{Route, Auth};

// ----------- Tanpa Login
Route::get('/', [WelcomeController::class, 'index']);

// ----------- Login Admin
Route::middleware(['auth'])->group(function () {

    /// Route Home
    Route::controller(App\Http\Controllers\HomeController::class)->group(function () {

        Route::get('/home', 'index')->middleware('checkRole:staff,admin');
        Route::get('barang/{id}/detail', 'detail')->middleware(['checkRole:staff,admin']);
        Route::post('barang/{id}/sirkulasi', 'sirkulasi')->middleware(['checkRole:staff,admin']);
    });

    /// Route Barang
    Route::controller(App\Http\Controllers\BarangController::class)->group(function () {

        Route::get('barang', 'index')->middleware(['checkRole:staff,admin']);
        Route::get('barang/create', 'create')->middleware(['checkRole:staff,admin']);
        Route::post('barang', 'store')->middleware(['checkRole:staff,admin']);
        Route::delete('barang/{barang}', 'destroy')->middleware(['checkRole:staff,admin']);
    });
    /// Route Setting
    Route::controller(App\Http\Controllers\SettingController::class)->group(function () {

        Route::get('setting', 'index')->middleware('checkRole:admin');
        /// Setting Jenis
        Route::post('setting/jenis', 'create1')->middleware('checkRole:admin');
        /// Setting Lokasi
        Route::post('setting/lokasi', 'create2')->middleware('checkRole:admin');
    });
    /// Route Sirkulasi
    Route::controller(App\Http\Controllers\SirkulasiController::class)->group(function () {

        Route::get('sirkulasi', 'index')->middleware(['checkRole:staff,admin']);
        Route::post('sirkulasi/create', 'create')->middleware(['checkRole:staff,admin']);
    });
});

Auth::routes([
    'register' => true,
]);
