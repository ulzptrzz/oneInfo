<?php

namespace App\Livewire\Guest;

use Livewire\Component;
use App\Models\Program as ModelProgram;

class Program extends Component
{
    public function render()
    {
        $program = ModelProgram::where('status', 'published')->orderBy('tanggal_mulai', 'desc')->with('kategoriProgram')->get();

        return view('livewire.guest.program', compact('program'));
    }
}
