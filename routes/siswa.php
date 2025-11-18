<?php

use App\Livewire\Siswa\Dashboard;
use App\Livewire\Siswa\ProfilSiswa;
use Illuminate\Support\Facades\Route;
use App\Livewire\Siswa\Program\BookmarkList as BookmarkList;
use App\Livewire\Siswa\Program\ListProgram;

Route::prefix('siswa')->middleware(['auth', 'role:siswa'])->group(function () {
    Route::get('/dashboard', Dashboard::class)->name('siswa.dashboard');
    Route::get('/list-program', ListProgram::class)->name('siswa.list-pendaftaran');
    Route::get('/bookmark', BookmarkList::class)->name('siswa.bookmark');
    Route::get('/profil-siswa', ProfilSiswa::class)->name('siswa.profile');
});
