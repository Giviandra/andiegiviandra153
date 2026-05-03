<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProdukController; // Import ProdukController
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// Semua rute di dalam grup ini wajib login
Route::middleware('auth')->group(function () {
    
    // Rute bawaan profil
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // --- RUTE PROJECT PRODUK ---
    
    // Rute yang bisa diakses Admin & User Biasa
    Route::get('/produk', [ProdukController::class, 'index'])->name('produk.index');
    Route::get('/produk/create', [ProdukController::class, 'create'])->name('produk.create');
    Route::post('/produk', [ProdukController::class, 'store'])->name('produk.store');
    Route::get('/produk/{id}/edit', [ProdukController::class, 'edit'])->name('produk.edit');
    Route::put('/produk/{id}', [ProdukController::class, 'update'])->name('produk.update');

    // RUTE DELETE: HANYA BISA DIAKSES ADMIN (Otorisasi)
    Route::delete('/produk/{id}', [ProdukController::class, 'destroy'])
        ->middleware('can:isAdmin')
        ->name('produk.destroy');
});

require __DIR__.'/auth.php';