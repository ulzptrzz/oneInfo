<?php

namespace App\Livewire;

use App\Models\Prestasi;
use App\Models\Program;
use App\Models\Artikel;
use App\Models\Siswa;
use Livewire\Component;

class Home extends Component
{
    public $prestasis, $program, $artikel, $totalProgram, $totalSiswa, $totalPrestasi, $totalArtikel;

    public function mount()
    {
        // Prestasi terbaru 
        $this->prestasis = Prestasi::with(['siswa.kelas.jurusan', 'program', 'dokumentasi'])
            ->latest('tanggal')
            ->take(6)
            ->get();

        // Semua program untuk katalog
        $this->program = Program::latest()->take(3)->get();

        // Artikel terbaru 
        $this->artikel = Artikel::latest('tanggal')->first();

        // Statistik
        $this->totalProgram  = Program::count();
        $this->totalSiswa    = Siswa::count();
        $this->totalPrestasi = Prestasi::count();
        $this->totalArtikel = Artikel::count();
    }

    public function render()
    {
        return view('livewire.home');
    }
}