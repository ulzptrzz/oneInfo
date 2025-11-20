<?php

namespace App\Livewire\Admin\Artikel;

use Livewire\Component;
use App\Models\Artikel;

class Index extends Component
{
    public $artikelId;

    public function mount(){

    }

    public function confirmDelete($id)
    {
        $this->confirmDeleteId = $id;
        $this->showDeleteModal = true;
    }

    public function hapus()
    {
        Artikel::findOrFail($this->confirmDeleteId)->delete();
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
        return view('livewire.admin.artikel.index');
    }
}
