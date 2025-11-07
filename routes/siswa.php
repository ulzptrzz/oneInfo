<?php

use App\Livewire\Siswa\Dashboard;
use Illuminate\Support\Facades\Route;

Route::prefix('siswa')->middleware(['auth', 'role:siswa'])->group( function() {
    Route::get('/dashboard', Dashboard::class)->name('siswa.dashboard');
});