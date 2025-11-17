<?php

namespace App\Livewire\Admin\Artikel;

use Livewire\Component;
use App\Models\Artikel;

class Detail extends Component
{
    public $artikel;

    public function mount($id)
    {
        $this->artikel = Artikel::findOrFail($id);
    }

    public function render()
    {
        return view('livewire.admin.artikel.detail');
    }
}
