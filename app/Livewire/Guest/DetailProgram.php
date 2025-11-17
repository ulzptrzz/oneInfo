<?php

namespace App\Livewire\Guest;

use App\Models\Program;
use Livewire\Component;

class DetailProgram extends Component
{
    public $program;

    public function mount($id)
    {
        $this->program = Program::with('kategoriProgram')->find($id);
    }
    public function render()
    {
        return view('livewire.guest.detail-program');
    }
}
