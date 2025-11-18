<?php

use App\Http\Controllers\ScheduleController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| ROUTES PUBLIC (TANPA LOGIN)
|--------------------------------------------------------------------------
| Route untuk fitur yang bisa diakses tanpa otentikasi.
*/

// Halaman utama (Dashboard) kini menjadi halaman yang dilihat setelah LOGIN.
// Kita set route / menjadi redirect ke login jika belum login, atau ke dashboard jika sudah.
Route::get('/', function () {
    return view('welcome'); // Gunakan view welcome/landing page sebelum login
})->name('welcome');

// Fitur Client-Side (bisa diakses siapa saja)
Route::view('/ipk', 'kalkulator_ipk')->name('ipk');
Route::view('/timer', 'study_timer')->name('timer');


/*
|--------------------------------------------------------------------------
| ROUTES PRIVATE (MEMERLUKAN LOGIN)
|--------------------------------------------------------------------------
| Route ini dilindungi oleh middleware 'auth'.
*/

Route::middleware(['auth'])->group(function () {
    
    // Dashboard sebenarnya (Setelah Login)
    Route::view('/dashboard', 'dashboard')->name('dashboard');
    
    // Fitur Jadwal (CRUD)
    Route::resource('jadwal', ScheduleController::class)->only(['index', 'store', 'destroy']);

    // Rute BARU untuk Profil (Memperbaiki error di navigation.blade.php)
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit'); // Tambahkan ini
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    
    // Tambahkan route lain yang memerlukan login di sini
});

// Route Autentikasi Breeze (Login, Register, dll.)
require __DIR__.'/auth.php';