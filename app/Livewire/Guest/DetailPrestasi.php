<?php

namespace App\Livewire\Guest;

use Livewire\Component;
use App\Models\Prestasi;

class DetailPrestasi extends Component
{
    public $prestasi;

    public function mount($id)
    {
        $this->prestasi = Prestasi::with(['siswa.kelas.jurusan', 'program', 'dokumentasi'])
            ->findOrFail($id);
    }

    public function render()
    {
        return view('livewire.guest.detail-prestasi');
    }
}