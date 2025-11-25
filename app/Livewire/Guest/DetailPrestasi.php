<?php

namespace App\Livewire\Guest;

use Livewire\Component;
use App\Models\Prestasi;

class DetailPrestasi extends Component
{
    public $prestasi; // Menampung detail prestasi

    public function mount($id)
    {
        // Ambil prestasi beserta relasinya
        $this->prestasi = Prestasi::with(['siswa.kelas.jurusan', 'program', 'dokumentasi'])
            ->findOrFail($id); // Jika tidak ditemukan → 404
    }

    public function render()
    {
        // Tampilkan halaman detail prestasi
        return view('livewire.guest.detail-prestasi');
    }
}