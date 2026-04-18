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
Route::get('/berita/{slug}', [PublicController::class, 'show'])->name('post.show');

// Arsip berdasarkan Kategori: /rubrik/ekonomi-kreatif
Route::get('/rubrik/{category:slug}', [PublicController::class, 'category'])->name('category.show');

// Arsip berdasarkan Tag/Topik: /topik/kupang
Route::get('/topik/{tag:slug}', [PublicController::class, 'tag'])->name('tag.show');

// --- INFORMASI INSTITUSIONAL & HALAMAN DINAMIS ---
/** * Senior Note: Kita menggunakan rute dinamis untuk halaman yang datanya diambil dari tabel 'pages'.
 * Ini mencakup: Kebijakan Privasi, Pedoman Siber, Kode Etik, dll.
 */
Route::get('/halaman/{slug}', [PublicController::class, 'page'])->name('page.show');

// Rute khusus untuk Redaksi karena memiliki logika grouping anggota yang kompleks di Controller
Route::get('/redaksi', [PublicController::class, 'redaksi'])->name('redaksi');

// Halaman lainnya yang masih bersifat fungsional/khusus
Route::get('/kontak', [PublicController::class, 'kontak'])->name('kontak');
Route::get('/karir', [PublicController::class, 'karir'])->name('karir');
Route::get('/info-iklan', [PublicController::class, 'iklan'])->name('iklan');

// --- FITUR ENGAGEMENT ---
Route::get('/suara-warga', [PublicController::class, 'suaraWarga'])->name('suara-warga');