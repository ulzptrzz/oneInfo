<?php

namespace App\Livewire\Siswa\Program;

use Livewire\Component;
use App\Models\Program;

class Katalog extends Component
{
    public function render()
    {
        $program = Program::where('status', 'published')->orderBy('tanggal_mulai','desc')->with('kategoriProgram')->get();
        return view('livewire.siswa.program.katalog', compact('program'));
    }
}
