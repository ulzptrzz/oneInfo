<?php

namespace App\Livewire;

use App\Models\User;
use App\Models\Artikel;
use App\Models\Prestasi;
use App\Models\Program;
use Livewire\Component;

class Home extends Component
{
    public $program, $artikel, $totalProgram, $totalSiswa, $totalPrestasi;

    public function mount()
    {
        $this->program = Program::where('status', 'published')
            ->latest()
            ->with('kategoriProgram')
            ->take(4)
            ->get();
        $this->artikel = Artikel::latest('created_at')->first();
        $this->totalProgram = Program::where('status', 'published')->count();
        $this->totalSiswa = User::where('role_id', '3')->count();
        $this->totalPrestasi = Prestasi::count();
    }
    public function render()
    {
        return view('livewire.home');
    }
}
