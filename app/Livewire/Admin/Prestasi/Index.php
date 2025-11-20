<?php

namespace App\Livewire\Admin\Prestasi;

use App\Models\Prestasi;
use Livewire\Component;

class Index extends Component
{
    public $confirmDeleteId = null;
    public $showDeleteModal = false;

    public $prestasi;

    public function mount()
    {
        $this->prestasi = Prestasi::with(['siswa', 'program', 'dokumentasi'])->get();
    }

    public function confirmDelete($id)
    {
        $this->confirmDeleteId = $id;
        $this->showDeleteModal = true;
    }

    public function hapus()
    {
        Prestasi::findOrFail($this->confirmDeleteId)->delete();
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
        return view('livewire.admin.prestasi.index');
    }
}
