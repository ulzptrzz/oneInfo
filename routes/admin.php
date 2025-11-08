<?php

use App\Livewire\Admin\{
    Dashboard,
    KategoriProgram\Index as KategoriProgramIndex,
    Program\Index as ProgramIndex,
    Perizinan\Index as PerizinanIndex
};

use Illuminate\Support\Facades\Route;

Route::prefix('admin')->middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/dashboard', Dashboard::class)->name('admin.dashboard');
    Route::get('/kategori-program', KategoriProgramIndex::class)->name('admin.kategori-program');
    Route::get('/program', ProgramIndex::class)->name('admin.program');
    Route::get('/perizinan', PerizinanIndex::class)->name('admin.perizinan');
});
