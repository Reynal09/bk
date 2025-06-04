<?php

use App\Http\Controllers\JadwalPeriksaController;
use App\Models\Obat;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ObatController;
use App\Http\Controllers\ProfileController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::middleware(['role:dokter'])->prefix('dokter')->as('dokter.')->group(function () {
        Route::get('/', function () {
            return view('dokter.dashboard');
        })->name('dashboard');

        Route::resource('obat', ObatController::class)->except(['show']);
        Route::resource('jadwal-periksa', JadwalPeriksaController::class)->except(['show']);
        // toggle status
        Route::patch('jadwal-periksa/{jadwalPeriksa}/toggle-status', [JadwalPeriksaController::class, 'toggleStatus'])->name('jadwal-periksa.toggle-status');
        // Route::prefix('obat')->group(function () {
        //     Route::get('/', [ObatController::class, 'index'])->name('obat.index');
        //     Route::get('/create', [ObatController::class, 'create'])->name('obat.create');
        //     Route::post('/store', [ObatController::class, 'store'])->name('obat.store');

        //     Route::get('/edit/{id}', [ObatController::class, 'edit'])->name('obat.edit');
        //     Route::put('/update/{id}', [ObatController::class, 'update'])->name('obat.update');

        //     Route::delete('destroy/{id}', [ObatController::class, 'destroy'])->name('obat.destroy');
        // });
    });
});

require __DIR__ . '/auth.php';
