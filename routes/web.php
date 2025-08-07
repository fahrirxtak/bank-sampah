<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\HargaSampahController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\NasabahController;



Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/admin/dashboard', function () {
        return view('admin.dashboard');
    })->name('admin.dashboard');

    // profile
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::match(['PUT', 'PATCH'], '/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Nasabah
    Route::get('/nasabah', [NasabahController::class, 'index'])->name('admin.nasabah.index');
    Route::get('/tambah-nasabah', [NasabahController::class, 'create'])->name('admin.nasabah.create');
    Route::post('/nasabah', [NasabahController::class, 'store'])->name('admin.nasabah.store');
    Route::get('/nasabah/{nasabah}/edit', [NasabahController::class, 'edit'])->name('admin.nasabah.edit');
    Route::put('/nasabah/{nasabah}', [NasabahController::class, 'update'])->name('admin.nasabah.update');
    Route::delete('/nasabah/{id}', [NasabahController::class, 'destroy'])->name('admin.nasabah.destroy');
});

Route::middleware(['auth', 'role:nasabah'])->group(function () {
    Route::get('/nasabah/dashboard', function () {
        return view('nasabah.dashboard');
    })->name('nasabah.dashboard');

    // harga sampah
    Route::get('/nasabah/harga-sampah', [HargaSampahController::class, 'index'])->name('harga.sampah');

    // saldo
    Route::get('/nasabah/saldo', [NasabahController::class, 'saldo'])->name('nasabah.saldo');


    // profile
    Route::get('/nasabah-profile', [ProfileController::class, 'nasabahedit'])->name('nasabah.profile.edit');
    Route::match(['PUT', 'PATCH'], '/nasabah-profile', [ProfileController::class, 'nasabahupdate'])->name('nasabah.profile.update');
    Route::delete('/nasabah-profile', [ProfileController::class, 'destroy'])->name('nasabah.profile.destroy');
});


Route::get('/', function () {
    return view('auth.login');
});


require __DIR__ . '/auth.php';
