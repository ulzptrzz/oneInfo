<?php

namespace App\Livewire\Guest;
use Livewire\Component;
use App\Models\Prestasi as PrestasiModel;
use App\Models\Jurusan;

class Prestasi extends Component
{
    public $prestasis;
    public $searchJurusan = ''; 
    public $jurusans; 

    public function mount()
    {
        $this->jurusans = Jurusan::orderBy('nama_jurusan')->get();
        $this->loadPrestasi();
    }
    public function updatedSearchJurusan()
    {
        $this->loadPrestasi();
    }
    public function loadPrestasi()
    {
        $query = PrestasiModel::with(['siswa.kelas.jurusan', 'program', 'dokumentasi'])
            ->orderBy('created_at', 'desc');

        if ($this->searchJurusan !== '') {
            $query->whereHas('siswa.kelas.jurusan', function ($q) {
                $q->where('id', $this->searchJurusan);
            });
        }
        $this->prestasis = $query->get();
    }
    public function render()
    {
        return view('livewire.guest.prestasi');
    }
}