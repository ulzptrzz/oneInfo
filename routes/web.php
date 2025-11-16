
<?php

use App\Livewire\Auth\Login;
use App\Livewire\Home;
use Illuminate\Support\Facades\Route;

Route::get('/', Home::class)->name('home');

Route::prefix('auth')->group( function(){
    Route::get('/login', Login::class)->name('login');
});

require_once __DIR__ . '/superadmin.php';
require_once __DIR__ . '/admin.php';
require_once __DIR__ . '/siswa.php';
