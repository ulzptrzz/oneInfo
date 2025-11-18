<?php

namespace App\Livewire\Siswa;

use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class ProfilSiswa extends Component
{
    public $user;
    public function mount(){
        $this->user = Auth::user();
    }
    public function render()
    {
        return view('livewire.siswa.profil-siswa');
    }
}
