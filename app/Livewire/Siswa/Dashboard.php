<?php

namespace App\Livewire\Siswa;

use App\Models\Siswa;
use Livewire\Component;

class Dashboard extends Component
{
    public $siswa;

    public function mount(){
        $this->siswa = Siswa::first();
    }
    public function render()
    {
        return view('livewire.siswa.dashboard');
    }
}
