<?php

use App\Livewire\Siswa\Dashboard;
use Illuminate\Support\Facades\Route;
use App\Livewire\Siswa\Program\BookmarkList as BookmarkList;

Route::prefix('siswa')->middleware(['auth', 'role:siswa'])->group( function() {
    Route::get('/dashboard', Dashboard::class)->name('siswa.dashboard');

Route::get('/bookmark', BookmarkList::class)
    ->name('siswa.bookmark');

});