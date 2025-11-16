<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Program;

class Home extends Component
{
    public function render()
    {
        $program = Program::where('status', 'published')->latest()->take(4)->with('kategoriProgram')->get();
        
        return view('livewire.home', compact('program'));
    }
}
