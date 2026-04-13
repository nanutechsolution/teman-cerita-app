<?php

use App\Http\Controllers\PublicController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes - Portal Berita Teman Cerita NTT
|--------------------------------------------------------------------------
|
| Rute di bawah ini mengatur seluruh alur navigasi publik. 
| Pastikan PublicController sudah memiliki method yang sesuai.
|
*/

// --- HALAMAN UTAMA & PENCARIAN ---
Route::get('/', [PublicController::class, 'index'])->name('home');
Route::get('/cari', [PublicController::class, 'search'])->name('search');
Route::get('/indeks', [PublicController::class, 'indeks'])->name('indeks');

// --- ARSIP KONTEN (SEO FRIENDLY) ---
// Menggunakan parameter slug agar URL terlihat profesional: /berita/judul-berita-anda
Route::get('/berita/{slug}', [PublicController::class, 'show'])->name('episode.show');

// Arsip berdasarkan Kategori: /rubrik/ekonomi-kreatif
Route::get('/rubrik/{category:slug}', [PublicController::class, 'category'])->name('category.show');

// Arsip berdasarkan Tag/Topik: /topik/kupang
Route::get('/topik/{tag:slug}', [PublicController::class, 'tag'])->name('tag.show');

// --- INFORMASI INSTITUSIONAL (STATIS/DINAMIS) ---
Route::get('/redaksi', [PublicController::class, 'redaksi'])->name('redaksi');
Route::get('/pedoman-media-siber', [PublicController::class, 'pedoman'])->name('pedoman');
Route::get('/tentang-kami', [PublicController::class, 'tentang'])->name('tentang');
Route::get('/kontak', [PublicController::class, 'kontak'])->name('kontak');
Route::get('/karir', [PublicController::class, 'karir'])->name('karir');

// --- FITUR ENGAGEMENT & LEGAL ---
Route::get('/suara-warga', [PublicController::class, 'suaraWarga'])->name('suara-warga');
Route::get('/disclaimer', [PublicController::class, 'disclaimer'])->name('disclaimer');
Route::get('/info-iklan', [PublicController::class, 'iklan'])->name('iklan');

/*
|--------------------------------------------------------------------------
| Auth & Admin Routes (Filament)
|--------------------------------------------------------------------------
| Biasanya Filament akan otomatis mendaftarkan rute /admin-nya sendiri.
*/