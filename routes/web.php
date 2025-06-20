<?php

use App\Models\Obat;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Dokter\ObatController;
use App\Http\Controllers\Dokter\MemeriksaController;
use App\Http\Controllers\Pasien\JanjiPeriksaController;
use App\Http\Controllers\Dokter\JadwalPeriksaController;
use App\Http\Controllers\pasien\RiwayatPeriksaController;

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

    Route::middleware(['role:dokter'])->prefix('dokter')->group(function () {
        Route::get('/', function () {
            return view('dokter.dashboard');
        })->name('dokter.dashboard');

        Route::prefix('obat')->group(function () {
            Route::get('/', [ObatController::class, 'index'])->name('dokter.obat.index');
            Route::get('/create', [ObatController::class, 'create'])->name('dokter.obat.create');
            Route::post('/store', [ObatController::class, 'store'])->name('dokter.obat.store');
            Route::get('/edit/{id}', [ObatController::class, 'edit'])->name('dokter.obat.edit');
            Route::put('/update/{id}', [ObatController::class, 'update'])->name('dokter.obat.update');
            Route::delete('destroy/{id}', [ObatController::class, 'destroy'])->name('dokter.obat.destroy');

            Route::get('/terhapus', [ObatController::class, 'bin'])->name('dokter.obat.bin');
            Route::patch('/restore/{id}', [ObatController::class, 'restore'])->name('dokter.obat.restore');
        });

        Route::prefix('jadwal-periksa')->group(function () {
            Route::get('/', [JadwalPeriksaController::class, 'index'])->name('dokter.jadwal-periksa.index');
            Route::get('/create', [JadwalPeriksaController::class, 'create'])->name('dokter.jadwal-periksa.create');
            Route::post('/', [JadwalPeriksaController::class, 'store'])->name('dokter.jadwal-periksa.store');
            Route::patch('/{id}', [JadwalPeriksaController::class, 'update'])->name('dokter.jadwal-periksa.update');
        });

        Route::prefix('memeriksa')->group(function () {
            Route::get('/', [MemeriksaController::class, 'index'])->name('dokter.memeriksa.index');
            Route::post('/{id}', [MemeriksaController::class, 'store'])->name('dokter.memeriksa.store');
            Route::get('/{id}/periksa', [MemeriksaController::class, 'periksa'])->name('dokter.memeriksa.periksa');
            Route::get('/{id}/edit', [MemeriksaController::class, 'edit'])->name('dokter.memeriksa.edit');
            Route::patch('/{id}', [MemeriksaController::class, 'update'])->name('dokter.memeriksa.update');
        });
    });
    

    Route::middleware(['role:pasien'])->prefix('pasien')->group(function () {
        Route::get('/', function () {
            return view('pasien.dashboard');
        })->name('pasien.dashboard');

        Route::prefix('janji-periksa')->group(function () {
            Route::get('/', [JanjiPeriksaController::class, 'index'])->name('pasien.janji-periksa.index');
            Route::post('/', [JanjiPeriksaController::class, 'store'])->name('pasien.janji-periksa.store');
        });

        Route::prefix('riwayat-periksa')->group(function () {
            Route::get('/', [RiwayatPeriksaController::class, 'index'])->name('pasien.riwayat-periksa.index');
            Route::get('/{id}/detail', [RiwayatPeriksaController::class, 'detail'])->name('pasien.riwayat-periksa.show');
            Route::get('/{id}/riwayat', [RiwayatPeriksaController::class, 'riwayat'])->name('pasien.riwayat-periksa.riwayat');
        });
    });

    Route::prefix('dokter')->as('dokter.')->middleware(['auth', 'role:dokter'])->group(function () {
    Route::get('jadwal-periksa/toggle-status', [JadwalPeriksaController::class, 'toggleStatus'])->name('jadwal-periksa.toggle-status');
});

});

require __DIR__ . '/auth.php';
