<?php

namespace App\Livewire\Guest;
use Livewire\Component;
use App\Models\Prestasi as PrestasiModel;
use App\Models\Jurusan;

class Prestasi extends Component
{
    public $prestasis;       // Menampung daftar prestasi
    public $searchJurusan = ''; // Untuk filter jurusan
    public $jurusans;        // Daftar jurusan untuk dropdown filter

    public function mount()
    {
        // Ambil list jurusan untuk dropdown filter (diurutkan berdasarkan nama)
        $this->jurusans = Jurusan::orderBy('nama_jurusan')->get();

        // Load daftar prestasi pertama kali
        $this->loadPrestasi();
    }

    public function updatedSearchJurusan()
    {
        // Saat user mengganti filter jurusan, reload data prestasi
        $this->loadPrestasi();
    }

    public function loadPrestasi()
    {
        // Ambil prestasi + relasi yang diperlukan
        $query = PrestasiModel::with(['siswa.kelas.jurusan', 'program', 'dokumentasi'])
            ->orderBy('created_at', 'desc');

        // Jika filter jurusan tidak kosong → filter data
        if ($this->searchJurusan !== '') {
            $query->whereHas('siswa.kelas.jurusan', function ($q) {
                $q->where('id', $this->searchJurusan);  // Filter berdasarkan ID jurusan
            });
        }

        // Menyimpan hasil ke variabel yang dirender di view
        $this->prestasis = $query->get();
    }

    public function render()
    {
        // Menampilkan halaman prestasi untuk guest
        return view('livewire.guest.prestasi');
    }
}