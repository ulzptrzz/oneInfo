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

    public $confirmDeleteId = null;
    public $showDeleteModal = false;

    public function mount()
    {
        $this->program = Program::all();
    }

    public function confirmDelete($id)
    {
        $this->confirmDeleteId = $id;
        $this->showDeleteModal = true;
    }

    public function hapus()
    {
        Program::findOrFail($this->confirmDeleteId)->delete();
        $this->showDeleteModal = false;
        $this->confirmDeleteId = null;
        $this->mount();
    }
    public function cancelDelete()
    {
        $this->showDeleteModal = false;
        $this->confirmDeleteId = null;
    }

    public function render()
    {
        return view('livewire.admin.program.index', ['program' => $this->program,]);
    }
}
