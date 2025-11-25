<?php

namespace App\Livewire\Guest;

use Livewire\Component;
use App\Models\Artikel;

class DetailArtikel extends Component
{
    public $artikel; // Menampung artikel utama yang ditampilkan

    public function mount($id)
    {
        // Cari artikel berdasarkan ID, jika tidak ada error 404
        $this->artikel = Artikel::findOrFail($id);
    }

    public function render()
    {
        // Ambil artikel lain yang berstatus 'publish' sebagai artikel terkait
        $relatedArtikels = Artikel::where('status', 'publish')
            ->where('id', '!=', $this->artikel->id)     // Jangan tampilkan artikel yang sama
            ->orderBy('tanggal', 'desc')
            ->take(3)                                   // Ambil hanya 3 artikel
            ->get();

        // Kirim data artikel terkait ke view
        return view('livewire.guest.detail-artikel', [
            'relatedArtikels' => $relatedArtikels,
        ]);
    }
}