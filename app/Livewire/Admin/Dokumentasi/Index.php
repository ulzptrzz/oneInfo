<?php

namespace App\Livewire\Admin\Dokumentasi;

use App\Models\Dokumentasi;

use Livewire\Component;

class Index extends Component
{
    public $dokumentasi;

    public $confirmDeleteId = null;
    public $showDeleteModal = false;

    public function mount()
    {
        $this->dokumentasi = Dokumentasi::all();
    }

    public function confirmDelete($id){
        $this->confirmDeleteId = $id;
        $this->showDeleteModal = true;
    }

    public function hapus(){
        Dokumentasi::findOrFail($this->confirmDeleteId)->delete();
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
        return view('livewire.admin.dokumentasi.index', [
            'dokumentasi' => $this->dokumentasi,
        ]);
    }
}
