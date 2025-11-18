<?php

namespace App\Livewire\Guest;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Artikel as ArtikelModel;

class Artikel extends Component
{
    public $artikels;

    public function mount() {
        $this->artikels = ArtikelModel::all();
    }
    public function render()
    {
        return view('livewire.guest.artikel');
    }
}