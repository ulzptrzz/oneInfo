<?php

namespace App\Livewire\Admin\Dokumentasi;

use App\Models\Dokumentasi;
use Livewire\Component;

class Index extends Component
{
    // Variabel untuk nampung semua data dokumentasi
    public $dokumentasi;

    // Variabel untuk proses konfirmasi hapus
    public $confirmDeleteId = null;
    public $showDeleteModal = false;

    // Fungsi yang dijalankan pas halaman pertama dibuka
    public function mount()
    {
        $this->dokumentasi = Dokumentasi::all(); // Ambil semua dokumentasi
    }

    // Pas tombol hapus diklik muncul modal konfirmasi
    public function confirmDelete($id){
        $this->confirmDeleteId = $id;
        $this->showDeleteModal = true;
    }

    // Eksekusi hapus data
    public function hapus(){
        Dokumentasi::findOrFail($this->confirmDeleteId)->delete(); // Hapus dari DB

        $this->showDeleteModal = false; // Tutup modal
        $this->confirmDeleteId = null; // Reset id
        $this->mount(); // Refresh data agar tampilan update
    }

    // Kalau user batal
    public function cancelDelete(){
        $this->showDeleteModal = false;
        $this->confirmDeleteId = null;
    }

    // Tampilkan halaman index
    public function render()
    {
        return view('livewire.admin.dokumentasi.index', [
            'dokumentasi' => $this->dokumentasi, // Kirim data ke view
        ]);
    }
}