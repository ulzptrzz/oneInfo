<?php

namespace App\Livewire\Superadmin\Siswa;

use App\Models\Siswa;
use Livewire\Component;

class AkunSiswa extends Component
{
    public $sesions = [];
    public $confirmDeleteId = null;
    public $showDeleteModal = false;

    public function mount()
    {
        $this->loadData();
    }

    public function loadData()
    {
        $this->sesions = Siswa::orderBy('name', 'desc')->get();
    }

    public function confirmDelete($id)
    {
        $this->confirmDeleteId = $id;
        $this->showDeleteModal = true;
    }

    public function hapus()
    {
        Siswa::findOrFail($this->confirmDeleteId)->delete();
        $this->showDeleteModal = false;
        $this->confirmDeleteId = null;
        $this->loadData();
    }

    public function cancelDelete()
    {
        $this->showDeleteModal = false;
        $this->confirmDeleteId = null;
    }
    public function render()
    {
        return view('livewire.superadmin.siswa.akun-siswa');
    }
}
