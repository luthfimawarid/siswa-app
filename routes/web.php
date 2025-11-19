<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SiswaController;
use Illuminate\Support\Facades\Route;

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
});
Route::middleware('auth')->group(function () {

    Route::get('/siswa', [SiswaController::class, 'index'])->name('siswa.index');

    Route::get('/siswa/create', [SiswaController::class, 'create'])->name('siswa.create');
    Route::post('/siswa', [SiswaController::class, 'store'])->name('siswa.store');

    Route::get('/siswa/{id}/edit', [SiswaController::class, 'edit'])->name('siswa.edit');
    Route::put('/siswa/{id}', [SiswaController::class, 'update'])->name('siswa.update');

    Route::delete('/siswa/{id}', [SiswaController::class, 'destroy'])->name('siswa.destroy');
    // Export Excel (menggunakan same filters query param)
    Route::get('/siswa/export', [SiswaController::class, 'export'])
        ->name('siswa.export');

    // Profile custom (lihat di langkah berikut)
    Route::get('/profile-kandidat', [ProfileController::class, 'candidate'])
        ->name('profile.kandidat');

    Route::get('/profile-kandidat', [ProfileController::class, 'candidate'])
        ->name('profile.kandidat');

    Route::post('/profile-kandidat/update', [ProfileController::class, 'updateCandidate'])
        ->name('profile.kandidat.update');
});

require __DIR__.'/auth.php';
