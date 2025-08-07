<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\HargaSampahController;



Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/admin/dashboard', function () {
        return view('admin.dashboard');
    })->name('admin.dashboard');

    // profile
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::match(['PUT', 'PATCH'], '/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware(['auth', 'role:nasabah'])->group(function () {
    Route::get('/nasabah/dashboard', function () {
        return view('nasabah.dashboard');
    })->name('nasabah.dashboard');

    // harga sampah
    Route::get('/nasabah/harga-sampah', [HargaSampahController::class, 'index'])->name('harga.sampah');


     // profile
    Route::get('/nasabah-profile', [ProfileController::class, 'nasabahedit'])->name('nasabah.profile.edit');
    Route::match(['PUT', 'PATCH'], '/nasabah-profile', [ProfileController::class, 'nasabahupdate'])->name('nasabah.profile.update');
    Route::delete('/nasabah-profile', [ProfileController::class, 'destroy'])->name('nasabah.profile.destroy');
});


Route::get('/', function () {
    return view('auth.login');
});


require __DIR__ . '/auth.php';
