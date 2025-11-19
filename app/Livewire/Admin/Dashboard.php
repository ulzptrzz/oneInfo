<?php

namespace App\Livewire\Admin;

use App\Models\Artikel;
use App\Models\Program;
use Livewire\Component;
use App\Models\Prestasi;
use App\Models\Dokumentasi;

class Dashboard extends Component
{
    public $totalProgram, $totalDokumentasi, $totalPrestasi, $totalArtikel;

    public function mount(){
        $this->totalProgram = Program::count();
        $this->totalDokumentasi = Dokumentasi::count();
        $this->totalPrestasi = Prestasi::count();
        $this->totalArtikel = Artikel::count();
    }
    public function render()
    {
        return view('livewire.admin.dashboard');
    }
}
