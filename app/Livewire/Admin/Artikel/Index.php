<?php

namespace App\Livewire\Admin\Artikel;

use Livewire\Component;
use App\Models\Artikel;

class Index extends Component
{
    public $artikelId;

    public function confirmDelete($id)
    {
        $this->artikelId = $id;
    }

    public function delete()
    {
        Artikel::find($this->artikelId)->delete();
        session()->flash('message', 'Artikel berhasil dihapus!');
        $this->artikelId = null;
    }

    public function render()
    {
        return view('livewire.admin.artikel.index', [
            'data' => Artikel::latest()->get()
        ]);
    }
}
