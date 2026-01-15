<?php

use App\Http\Controllers\Admin\MahasiswaController;
use App\Http\Controllers\JadwalController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Admin\MataKuliahController;
use App\Http\Controllers\Admin\DosenController;
// use App\Http\Controllers\Admin\AdminDashboardController; <--- DIHAPUS
use Illuminate\Support\Facades\Route;

use App\Livewire\Dashboard;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

Route::get('/dashboard', Dashboard::class)->name('dashboard');

// RUTE PUBLIK
Route::get('/', function () {
    return view('welcome');
})->middleware('guest');

// Rute Form Pengaduan/Kontak (Dapat diakses publik)
Route::get('/contact', function () {
    return view('contact'); 
})->name('contact.form');

//---

// RUTE TERLINDUNGI (Memerlukan Login)
Route::middleware(['auth', 'verified'])->group(function () {

    // 1. Rute Khusus Export & Import (Tambahkan ini!)
    Route::get('admin/mahasiswa/export', [MahasiswaController::class, 'export'])->name('admin.mahasiswa.export');
    Route::post('admin/mahasiswa/import', [MahasiswaController::class, 'import'])->name('admin.mahasiswa.import');

    // 2. Rute Resource Mahasiswa (yang sudah Anda punya)
    Route::resource('admin/mahasiswa', MahasiswaController::class)->names('admin.mahasiswa');
    
    // Rute Jadwal (Akses Umum)
    Route::get('/jadwal', [JadwalController::class, 'index'])->name('jadwal.index');
    
    // Rute Dashboard (Tujuan Default setelah Login - Logika Redirect)
    Route::get('/dashboard', function () {
        // Jika Admin, langsung REDIRECT ke dashboard khusus Admin
        if (auth()->user()->role === 'admin') {
            return redirect()->route('admin.dashboard'); 
        }
        // Jika Mahasiswa (User Biasa), tampilkan view dashboard biasa
        return view('dashboard'); 
    })->name('dashboard');

    // Rute Profile (Dropdown Edit Profil mengarah ke sini)
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');

    // =========================================================
    // RUTE ADMIN (Level 9 - Memerlukan Role 'admin')
    // =========================================================
    Route::prefix('admin')->name('admin.')->middleware('can:is_admin')->group(function () {
        
        // Dashboard Admin (Kembali menggunakan Closure/Fungsi Anonim)
        Route::get('/dashboard', function () {
            return view('admin.dashboard'); 
        })->name('dashboard');

        // TAMBAHKAN RUTE MAHASISWA DI SINI
        Route::get('/mahasiswa', [MahasiswaController::class, 'index'])->name('mahasiswa.index');
        Route::get('/mahasiswa/{user}/edit', [MahasiswaController::class, 'edit'])->name('mahasiswa.edit');
        Route::patch('/mahasiswa/{user}', [MahasiswaController::class, 'update'])->name('mahasiswa.update');

        // Rute CRUD Mata Kuliah
        Route::resource('matkul', MataKuliahController::class);
        
        // Rute CRUD Dosen
        Route::resource('dosen', DosenController::class); 

        // Rute CRUD JADWAL
        Route::resource('jadwal', JadwalController::class); 
    });
});


// MEMUAT RUTE AUTENTIKASI (LOGIN, REGISTER, LOGOUT)
require __DIR__.'/auth.php';

Route::middleware(['auth', 'role:admin'])->get('/tes-admin', function () {
    return '✅ Anda ADMIN';
});

Route::middleware(['auth', 'role:mahasiswa'])->get('/tes-mahasiswa', function () {
    return '✅ Anda MAHASISWA';
});