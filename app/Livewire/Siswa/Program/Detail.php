<?php

namespace App\Livewire\Siswa\Program;

use Livewire\Component;
use App\Models\Program;

class Detail extends Component
{
    public $program;
    public function mount($id) {
        $this->program = Program::with('kategoriProgram')->findOrFail($id);
    }
    
    public function render()
    {
        return view('livewire.siswa.program.detail');
    }
}
