<?php

use Illuminate\Support\Facades\Route;
use App\Livewire\Admin\Dashboard;
use App\Livewire\Admin\KategoriProgram\Create;
use App\Livewire\Admin\KategoriProgram\Edit;
use App\Livewire\Admin\KategoriProgram\Index;
use App\Livewire\Admin\Perizinan\Create as PerizinanCreate;
use App\Livewire\Admin\Perizinan\Index as PerizinanIndex;
use App\Livewire\Admin\Perizinan\Edit as PerizinanEdit;
use App\Livewire\Admin\Program\Create as ProgramCreate;
use App\Livewire\Admin\Program\Edit as ProgramEdit;
use App\Livewire\Admin\Program\Index as ProgramIndex;
use App\Livewire\Admin\Program\Detail as ProgramDetail;
use App\Livewire\Admin\Dokumentasi\Index as DokumentasiIndex;
use App\Livewire\Admin\Dokumentasi\Create as DokumentasiCreate;
use App\Livewire\Admin\Dokumentasi\Edit as DokumentasiEdit;
use App\Livewire\Admin\Prestasi\Index as PrestasiIndex;
use App\Livewire\Admin\Prestasi\Create as PrestasiCreate;
use App\Livewire\Admin\Prestasi\Edit as PrestasiEdit;
use App\Livewire\Admin\Artikel\Index as ArtikelIndex;
use App\Livewire\Admin\Artikel\Create as ArtikelCreate;
use App\Livewire\Admin\Artikel\Edit as ArtikelEdit;
use App\Livewire\Admin\Artikel\Detail as ArtikelDetail;



Route::prefix('admin')->middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/dashboard', Dashboard::class)->name('admin.dashboard');

    Route::get('/kategori-program', Index::class)->name('admin.kategori-program');
    Route::get('/kategori-program/create', Create::class)->name('create-kategori');
    Route::get('/kategori-program/edit/{id}', Edit::class)->name('edit-kategori');

    Route::get('/program', ProgramIndex::class)->name('admin.program');
    Route::get('/program/create', ProgramCreate::class)->name('create-program');
    Route::get('/program/edit/{id}', ProgramEdit::class)->name('edit-program');
    Route::get('/program/detail/{id}', ProgramDetail::class)->name('detail-program');

    Route::get('/perizinan', PerizinanIndex::class)->name('admin.perizinan');
    Route::get('/perizinan/create', PerizinanCreate::class)->name('create-perizinan');
    Route::get('/perizinan/edit/{id}', PerizinanEdit::class)->name('edit-perizinan');
    Route::get('/perizinan/edit', ProgramEdit::class)->name('edit-perizinan');

    Route::get('/dokumentasi', DokumentasiIndex::class)->name('admin.dokumentasi');
    Route::get('/dokumentasi/create', DokumentasiCreate::class)->name('create-dokumentasi');
    Route::get('/dokumentasi/edit/{id}', DokumentasiEdit::class)->name('edit-dokumentasi');

    Route::get('/prestasi', PrestasiIndex::class)->name('admin.prestasi');
    Route::get('/prestasi/create', PrestasiCreate::class)->name('create-prestasi');
    Route::get('/prestasi/edit/{id}', PrestasiEdit::class)->name('edit-prestasi');
    
    Route::get('/artikel', ArtikelIndex::class)->name('admin.artikel');
    Route::get('/artikel/create', ArtikelCreate::class)->name('create-artikel');
    Route::get('/Artikel/edit/{id}', ArtikelEdit::class)->name('edit-artikel');
    Route::get('/admin/artikel/detail/{id}', ArtikelDetail::class)->name('detail-artikel');

});
