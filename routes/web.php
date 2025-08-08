<?php

use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\NasabahController as AdminNasabahController;
use App\Http\Controllers\Admin\SampahController;
use App\Http\Controllers\Admin\SetorController;
use App\Http\Controllers\Admin\TransaksiOperasionalController;
use App\Http\Controllers\DashboardNasabahController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\HargaSampahController;
use App\Http\Controllers\NasabahController;
use App\Http\Controllers\RiwayatNasabahController;
use Illuminate\Support\Facades\Route;

// ===========================
// ADMIN ROUTES
// ===========================
Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/admin/dashboard', [DashboardController::class, 'index'])->name('admin.dashboard');

    // Profile Admin
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::match(['PUT', 'PATCH'], '/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Manajemen Nasabah
    Route::get('/nasabah', [AdminNasabahController::class, 'index'])->name('admin.nasabah.index');
    Route::get('/tambah-nasabah', [AdminNasabahController::class, 'create'])->name('admin.nasabah.create');
    Route::post('/nasabah', [AdminNasabahController::class, 'store'])->name('admin.nasabah.store');
    Route::get('/nasabah/{nasabah}/edit', [AdminNasabahController::class, 'edit'])->name('admin.nasabah.edit');
    Route::put('/nasabah/{nasabah}', [AdminNasabahController::class, 'update'])->name('admin.nasabah.update');
    Route::delete('/nasabah/{nasabah}', [AdminNasabahController::class, 'destroy'])->name('admin.nasabah.destroy');

    // manajemen sampah
    Route::get('/sampah', [SampahController::class, 'index'])->name('admin.sampah.index');
    Route::get('/sampah/create', [SampahController::class, 'create'])->name('admin.sampah.create');
    Route::post('/sampah', [SampahController::class, 'store'])->name('admin.sampah.store');
    Route::get('/sampah/{id}/edit', [SampahController::class, 'edit'])->name('admin.sampah.edit');
    Route::put('/sampah/{id}', [SampahController::class, 'update'])->name('admin.sampah.update');
    Route::delete('/sampah/{id}', [SampahController::class, 'destroy'])->name('admin.sampah.destroy');


    // manajemen setor & tarik
    Route::get('/setor-sampah', [SetorController::class, 'index'])->name('admin.setor.index');
    Route::post('/setor', [SetorController::class, 'store'])->name('setor.sampah.store');
    Route::post('/setor-tunai', [SetorController::class, 'storeTunai'])->name('setor.tunai.store');

    Route::post('/penarikan/admin', [SetorController::class, 'tarikOlehAdmin'])->name('penarikan.admin');
    Route::patch('penarikan/{id}/konfirmasi', [SetorController::class, 'konfirmasi'])->name('admin.penarikan.konfirmasi');

    // transaksi operasional
    Route::get('/transaksi-operasional', [TransaksiOperasionalController::class, 'index'])->name('admin.transaksi.index');
    Route::get('/transaksi-operasional/create', [TransaksiOperasionalController::class, 'create'])->name('admin.transaksi.create');
    Route::post('/transaksi-operasional', [TransaksiOperasionalController::class, 'store'])->name('admin.transaksi.store');
    Route::get('/transaksi-operasional/{transaksi}/edit', [TransaksiOperasionalController::class, 'edit'])->name('admin.transaksi.edit');
    Route::put('/transaksi-operasional/{transaksi}', [TransaksiOperasionalController::class, 'update'])->name('admin.transaksi.update');
    Route::delete('/transaksi-operasional/{transaksi}', [TransaksiOperasionalController::class, 'destroy'])->name('admin.transaksi.destroy');


    // manajemen setor & tarik
    Route::get('/setor-sampah', [SetorController::class, 'index'])->name('admin.setor.index');
    Route::post('/setor', [SetorController::class, 'store'])->name('setor.sampah.store');
});

// ===========================
// NASABAH ROUTES
// ===========================
Route::middleware(['auth', 'role:nasabah'])->group(function () {
    Route::get('/nasabah/dashboard', [DashboardNasabahController::class, 'index'])->name('nasabah.dashboard');

    // Harga Sampah
    Route::get('/nasabah/riwayat-transaksi', [RiwayatNasabahController::class, 'index'])->name('nasabah.riwayat.index');

    // Harga Sampah
    Route::get('/nasabah/harga-sampah', [HargaSampahController::class, 'index'])->name('harga.sampah');

    // Saldo Nasabah (HARUS diarahkan ke method saldo, bukan index)
    Route::get('/nasabah/saldo', [NasabahController::class, 'saldo'])->name('nasabah.saldo');

    // tarik tunai
    Route::get('/nasabah/tarik-tunai', [NasabahController::class, 'tarikTunai'])->name('nasabah.tarik.tunai');
    Route::post('/tarik-saldo', [NasabahController::class, 'store'])->name('tarik.store');


    // Profile Nasabah
    Route::get('/nasabah-profile', [ProfileController::class, 'nasabahedit'])->name('nasabah.profile.edit');
    Route::match(['PUT', 'PATCH'], '/nasabah-profile', [ProfileController::class, 'nasabahupdate'])->name('nasabah.profile.update');
    Route::delete('/nasabah-profile', [ProfileController::class, 'destroy'])->name('nasabah.profile.destroy');
});

// ===========================
// DEFAULT ROUTE
// ===========================
Route::get('/', function () {
    return view('auth.login');
});

// ===========================
// AUTH ROUTES
// ===========================
require __DIR__ . '/auth.php';
