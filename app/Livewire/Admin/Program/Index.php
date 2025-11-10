<?php

namespace App\Livewire\Admin\Program;

use Livewire\Component;
use Livewire\WithFileUploads;
use App\Models\Program;
use Illuminate\Support\Facades\Auth;
use App\Models\KategoriProgram;

class Index extends Component
{
    public $program;

    public function mount(){
        $user = Auth::user();

        $this->program = Program::all();
    }

    public function delete($id){
        $program = Program::find($id);

        if($program){
            $program->delete();
            session()->flash('message', 'Kategori berhasil dihapus.');

            $this->program = Program::orderBy('id', 'desc')->get();
        }
    }

    public function render()
    {
        return view('livewire.admin.program.index', ['program' => $this->program,]);
    }
}
