<?php

namespace App\Livewire;

use App\Models\Prestasi;
use App\Models\Program;
use App\Models\Artikel;
use App\Models\Siswa;
use Livewire\Component;

class Home extends Component
{
    public $prestasis;
    public $program;
    public $artikel;
    public $totalProgram;
    public $totalSiswa;
    public $totalPrestasi;

    public function mount()
    {
        // Prestasi terbaru (max 6)
        $this->prestasis = Prestasi::with(['siswa.kelas.jurusan', 'program', 'dokumentasi'])
            ->latest('tanggal')
            ->take(6)
            ->get();

        // Semua program untuk katalog
        $this->program = Program::latest()->get();

        // Artikel terbaru (hanya 1 untuk hero)
        $this->artikel = Artikel::latest('tanggal')->first();

        // Statistik
        $this->totalProgram  = Program::count();
        $this->totalSiswa    = Siswa::count();
        $this->totalPrestasi = Prestasi::count();
    }

    public function render()
    {
        return view('livewire.home');
    }
}