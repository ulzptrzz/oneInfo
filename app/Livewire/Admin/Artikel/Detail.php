<?php

namespace App\Livewire\Admin\Artikel;

use Livewire\Component;
use App\Models\Artikel;

class Detail extends Component
{
    public $artikel; // Menampung detail artikel berdasarkan ID

    // Fungsi untuk mengambil artikel berdasarkan ID saat komponen di-load
    public function mount($id)
    {
        $this->artikel = Artikel::findOrFail($id);
    }

    // Render tampilan detail.blade.php
    public function render()
    {
        return view('livewire.admin.artikel.detail');
    }
}