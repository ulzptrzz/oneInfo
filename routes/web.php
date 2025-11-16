
<?php

use App\Livewire\Auth\Login;
use App\Livewire\Home;
use Illuminate\Support\Facades\Route;
use App\Livewire\Siswa\Program\Katalog as KatalogProgram;
use App\Livewire\Siswa\Program\Detail as KatalogDetail;

Route::get('/', Home::class)->name('home');
Route::get('/program', KatalogProgram::class)->name('katalog-program');
    Route::get('/program/detail/{id}', KatalogDetail::class)->name('katalog-detail');

Route::prefix('auth')->group( function(){
    Route::get('/login', Login::class)->name('login');
    
});

require_once __DIR__ . '/superadmin.php';
require_once __DIR__ . '/admin.php';
require_once __DIR__ . '/siswa.php';
