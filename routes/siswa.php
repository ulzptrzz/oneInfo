<?php

use App\Livewire\Siswa\Dashboard;
use Illuminate\Support\Facades\Route;

use App\Livewire\Siswa\Program\Katalog as KatalogProgram;
use App\Livewire\Siswa\Program\Detail as KatalogDetail;

Route::prefix('siswa')->middleware(['auth', 'role:siswa'])->group( function() {
    Route::get('/dashboard', Dashboard::class)->name('siswa.dashboard');

    
});