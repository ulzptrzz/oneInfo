<?php

namespace App\Livewire\Siswa\Program;

use App\Models\Program;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;

class JoinProgram extends Component
{
    public $program;

    public function mount($id){
        $this->program = Program::with('kategoriProgram')->findOrFail($id);
    }

    public function joinProgram(){
        $user = Auth::id();
        
    }
    public function render()
    {
        return view('livewire.siswa.program.join-program');
    }
}
