<?php

namespace App\Livewire\Admin\Prestasi;

use App\Models\Prestasi;
use Livewire\Component;

class Index extends Component
{
    // Variabel untuk menampung id prestasi yang mau dihapus
    public $confirmDeleteId = null;

    // Buat nampilin pop-up konfirmasi hapus
    public $showDeleteModal = false;

    // Variabel buat nampung semua data prestasi
    public $prestasi;

    // Fungsi yang dijalanin pas halaman pertama kali dibuka
    public function mount()
    {
        // Ambil semua data prestasi lengkap sama relasinya
        $this->prestasi = Prestasi::with(['siswa', 'program', 'dokumentasi'])->get();
    }

    // Pas tombol hapus diklik → munculin modal konfirmasi
    public function confirmDelete($id)
    {
        $this->confirmDeleteId = $id;
        $this->showDeleteModal = true;
    }

    // Kalo user beneran mau hapus data eksekusi di sini
    public function hapus()
    {
        Prestasi::findOrFail($this->confirmDeleteId)->delete(); // Hapus datanya
        $this->showDeleteModal = false; // Tutup modal
        $this->confirmDeleteId = null; // Reset id
        $this->mount(); // Refresh ulang data yang tampil
    }

    // Kalau user batal hapus
    public function cancelDelete()
    {
        $this->showDeleteModal = false;
        $this->confirmDeleteId = null;
    }

    // Tampilkan halaman index
    public function render()
    {
        return view('livewire.admin.prestasi.index');
    }
}