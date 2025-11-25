<?php

namespace App\Livewire\Admin\Artikel;

use Livewire\Component;
use App\Models\Artikel;

class Index extends Component
{
    public $artikel; // Semua data artikel
    public $confirmDeleteId = null; // ID artikel yang ingin dihapus
    public $showDeleteModal = false; // Mengontrol modal konfirmasi

    // Fungsi yang dijalankan pas halaman pertama dibuka
    public function mount(){
        $this->artikel = Artikel::all();
    }

    // Tampilkan modal konfirmasi hapus
    public function confirmDelete($id)
    {
        $this->confirmDeleteId = $id;
        $this->showDeleteModal = true;
    }

    // Fungsi untuk menghapus artikel berdasarkan ID
    public function hapus()
    {
        Artikel::findOrFail($this->confirmDeleteId)->delete();

        // Tutup modal setelah hapus
        $this->showDeleteModal = false;
        $this->confirmDeleteId = null;

        // Refresh data
        $this->mount();
    }

    // Batalkan penghapusan
    public function cancelDelete()
    {
        $this->showDeleteModal = false;
        $this->confirmDeleteId = null;
    }

    // Render tampilan index.blade.php
    public function render()
    {
        return view('livewire.admin.artikel.index');
    }
}