<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController; // Tambahan import baru
use App\Http\Controllers\MenuController;
use App\Http\Controllers\LaporanController;
use Illuminate\Support\Facades\Route;

// =============================================================
// 1. ROUTE UNTUK TAMU (Belum Login)
// =============================================================
Route::middleware('guest')->group(function () {
    Route::get('/', [AuthController::class, 'showLogin'])->name('login');
    Route::get('/login', [AuthController::class, 'showLogin']);
    Route::post('/login', [AuthController::class, 'login']);
    
    Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
    Route::post('/register', [AuthController::class, 'register']);
});

// =============================================================
// 2. ROUTE UNTUK PENJUAL (Wajib Login) - Proteksi Halaman (Langkah 6)
// =============================================================
Route::middleware('auth')->group(function () {
    
    // --- AUTENTIKASI & DASHBOARD ---
    // Halaman Utama Dashboard Penjual (Diubah ke DashboardController)
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    
    // Proses Keluar Akun (Logout)
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
    
    
    // --- CRUD MANAJEMEN MENU KANTIN (Mengarah ke MenuController) ---
    // Halaman Utama Kelola Menu (Menampilkan SEMUA daftar menu untuk proses CRUD)
    Route::get('/menu', [MenuController::class, 'indexMenu'])->name('menu.index');
    
    // A. Fitur Tambah Menu
    Route::get('/menu/tambah', [MenuController::class, 'showTambahMenu'])->name('menu.tambah');
    Route::post('/menu/simpan', [MenuController::class, 'simpanMenu'])->name('menu.simpan');
    
    // B. Fitur Edit & Update Menu (Menggunakan Method GET dan PUT)
    Route::get('/menu/edit/{id}', [MenuController::class, 'showEditMenu'])->name('menu.edit');
    Route::put('/menu/update/{id}', [MenuController::class, 'updateMenu'])->name('menu.update');
    
    // C. Fitur Hapus Menu (WAJIB Menggunakan Method DELETE sesuai Form di Tabel Kerja)
    Route::delete('/menu/hapus/{id}', [MenuController::class, 'hapusMenu'])->name('menu.hapus');


    // --- MANAJEMEN LAPORAN (Mengarah ke LaporanController) ---
    // 1. Pratinjau (Preview) Halaman Cetak Laporan Menu
    Route::get('/laporan', [LaporanController::class, 'indexLaporan'])->name('laporan.index');
    // 2. Menampilkan halaman khusus cetak dokumen daftar menu otomatis (window.print)
    Route::get('/laporan/cetak', [LaporanController::class, 'cetakLaporan'])->name('laporan.cetak');
    
});