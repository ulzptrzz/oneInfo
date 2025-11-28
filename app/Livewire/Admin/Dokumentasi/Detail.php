<?php

namespace App\Livewire\Admin\Dokumentasi;

use Livewire\Component;
use App\Models\Dokumentasi;

class Detail extends Component
{
    public $dokumentasi;
    public $foto = [];

    public function mount($id)
    {
        // Ambil data dokumentasi dengan relasi prestasi dan siswa
        $this->dokumentasi = Dokumentasi::with(['prestasi.siswa'])->findOrFail($id);
        
        // Decode foto JSON
        $this->foto = is_string($this->dokumentasi->foto) 
            ? json_decode($this->dokumentasi->foto, true) ?? [] 
            : $this->dokumentasi->foto ?? [];
    }

    public function render()
    {
        return view('livewire.admin.dokumentasi.detail');
    }
}