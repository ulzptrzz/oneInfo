<?php

namespace App\Livewire\Guest;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Artikel as ArtikelModel;

class Artikel extends Component
{
    public $artikels; // Menampung semua artikel

    public function mount() {
        // Ambil semua data artikel saat komponen pertama kali dimuat
        $this->artikels = ArtikelModel::all();
    }

    public function render()
    {
        // Tampilkan halaman artikel untuk guest
        return view('livewire.guest.artikel');
    }
}