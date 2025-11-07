<?php

use App\Livewire\Superadmin\Dashboard;
use Illuminate\Support\Facades\Route;

Route::prefix('superadmin')->middleware(['auth', 'role:superadmin'])->group( function() {
    Route::get('/dashboard', Dashboard::class)->name('superadmin.dashboard');
});