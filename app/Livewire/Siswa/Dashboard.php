<?php

namespace App\Livewire\Siswa;

use App\Models\Siswa;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;

class Dashboard extends Component
{
    public $siswa;

    public function mount(){
        $this->siswa = Siswa::where('user_id', Auth::id())->first();
    }
    public function render()
    {
        return view('livewire.siswa.dashboard');
    }
}
