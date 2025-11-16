<?php

namespace App\Livewire\Admin\Program;

use Livewire\Component;
use App\Models\Program;

class Detail extends Component
{
    public $program;

    public function mount($id){
        $this->program = Program::with('kategoriProgram')->find($id);
    }

    public function render()
    {
        return view('livewire.admin.program.detail');
    }
}
