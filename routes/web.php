
<?php

use App\Livewire\Auth\Login;
use App\Livewire\Guest\Artikel;
use App\Livewire\Guest\BuktiPendaftaran;
use App\Livewire\Guest\Dokumentasi;
use App\Livewire\Guest\DetailProgram;
use App\Livewire\Guest\DetailArtikel;
use App\Livewire\Guest\Prestasi;
use App\Livewire\Guest\DetailPrestasi;
use App\Livewire\Guest\Program;
use App\Livewire\Home;
use Illuminate\Support\Facades\Route;

Route::get('/', Home::class)->name('home');
Route::get('/program', Program::class)->name('list-program');
Route::get('/program/detail/{id}', DetailProgram::class)->name('guest-detail-program');
Route::get('/program/detail/pendaftaran/{id}', BuktiPendaftaran::class)->name('guest.bukti-pendaftaran');
Route::get('/artikel', Artikel::class)->name('list-artikel');
Route::get('/artikel/detail/{id}', DetailArtikel::class)->name('guest.artikel.detail');
Route::get('/prestasi', Prestasi::class)->name('list-prestasi');
Route::get('/prestasi/detail/{id}', DetailPrestasi::class)->name('guest.prestasi.detail');

Route::prefix('auth')->group(function () {
    Route::get('/login', Login::class)->name('login');
});

require_once __DIR__ . '/superadmin.php';
require_once __DIR__ . '/admin.php';
require_once __DIR__ . '/siswa.php';
