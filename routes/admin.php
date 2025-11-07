<?php 

use App\Livewire\Admin\Dashboard;
use Illuminate\Support\Facades\Route;

Route::prefix('admin')->middleware(['auth', 'role:admin'])->group( function() {
    Route::get('/dashboard', Dashboard::class)->name('admin.dashboard');
});