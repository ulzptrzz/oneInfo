<?php

namespace App\Livewire\Siswa;

use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class ProfilSiswa extends Component
{
    // Properti untuk menampung data user
    public $user;

    // Fungsi yang dijalankan saat komponen pertama kali dimuat
    public function mount(){
        // Ambil data user yang sedang login
        $this->user = Auth::user();
    }

    // Fungsi untuk merender tampilan Blade
    public function render()
    {
        return view('livewire.siswa.profil-siswa');
    }
}