<?php

namespace App\Livewire\Guest;

use Livewire\Component;
use App\Models\Artikel;

class DetailArtikel extends Component
{
    public $artikel;

    public function mount($id)
    {
        $this->artikel = Artikel::findOrFail($id);
    }

    public function render()
    {
        // Related articles
        $relatedArtikels = Artikel::where('status', 'publish')
            ->where('id', '!=', $this->artikel->id)
            ->orderBy('tanggal', 'desc')
            ->take(3)
            ->get();

        return view('livewire.guest.detail-artikel', [
            'relatedArtikels' => $relatedArtikels,
        ]);
    }
}
