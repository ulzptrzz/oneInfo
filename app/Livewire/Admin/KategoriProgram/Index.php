<?php

namespace App\Livewire\Admin\KategoriProgram;

use App\Models\KategoriProgram;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Index extends Component
{
    public $kategoriProgram;
    public $confirmDeleteId = null;
    public $showDeleteModal = false; 

    public function mount(){
        $this->kategoriProgram = KategoriProgram::all();
    }

    public function confirmDelete($id){
        $this->confirmDeleteId = $id;
        $this->showDeleteModal = true;
    }

    public function hapus()
    {
        KategoriProgram::findOrFail($this->confirmDeleteId)->delete();
        $this->showDeleteModal = false;
        $this->confirmDeleteId = null;
        $this->mount();
    }

    public function cancelDelete(){
        $this->showDeleteModal = false;
        $this->confirmDeleteId = null;
    }

    public function render()
    {
        return view('livewire.admin.kategori-program.index', ['kategori' => $this->kategoriProgram,]);
    }
}
