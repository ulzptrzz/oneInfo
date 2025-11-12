<?php

use App\Livewire\Superadmin\Admin\AkunAdmin;
use App\Livewire\Superadmin\Admin\CreateAdmin;
use App\Livewire\Superadmin\Admin\EditAdmin;
use App\Livewire\Superadmin\Siswa\AkunSiswa;
use App\Livewire\Superadmin\Siswa\CreateKelas;
use App\Livewire\Superadmin\Dashboard;
use App\Livewire\Superadmin\Siswa\CreateSiswa;
use App\Livewire\Superadmin\Siswa\EditKelas;
use App\Livewire\Superadmin\Siswa\EditSiswa;
use App\Livewire\Superadmin\Siswa\KelasSiswa;
use Illuminate\Support\Facades\Route;

Route::prefix('superadmin')->middleware(['auth', 'role:superadmin'])->group( function() {
    Route::get('/dashboard', Dashboard::class)->name('superadmin.dashboard');
    
    //Kelola Kelas Siswa
    Route::get('/kelola-kelas', KelasSiswa::class)->name('superadmin.siswa.kelas-siswa');
    Route::get('/create-kelas', CreateKelas::class)->name('superadmin.siswa.create-kelas-siswa');
    Route::get('/edit-kelas/{id}', EditKelas::class)->name('superadmin.siswa.edit-kelas-siswa');
    
    //Kelola Siswa
    Route::get('/kelola-siswa', AkunSiswa::class)->name('superadmin.siswa.akun-siswa');
    Route::get('/create-siswa', CreateSiswa::class)->name('superadmin.siswa.create-siswa');
    Route::get('/edit-siswa/{id}', EditSiswa::class)->name('superadmin.siswa.edit-siswa');

    //Kelola Admin
    Route::get('/kelola-admin', AkunAdmin::class)->name('superadmin.admin.akun-admin');
    Route::get('/create-admin', CreateAdmin::class)->name('superadmin.admin.create-admin');
    Route::get('/edit-admin/{id}', EditAdmin::class)->name('superadmin.admin.edit-admin');
});